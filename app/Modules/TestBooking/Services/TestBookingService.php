<?php

namespace App\Modules\TestBooking\Services;

use App\Enums\CalculationType;
use App\Enums\JobStatus;
use App\Enums\TestCancellation;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\JobOrder\Models\JobOrder;
use App\Modules\JobOrderHistory\Models\JobOrderHistory;
use App\Modules\Patient\Models\Patient;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\StockJournalReference\Models\StockJournalReference;
use App\Modules\TestBooking\Contracts\TestBookingServiceInterface;
use App\Modules\TestBooking\Models\TestBooking;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;
use App\Modules\TransactionInstrument\Models\TransactionInstrument;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use App\Modules\VoucherPatient\Models\VoucherPatient;
use App\Modules\VoucherReference\Models\VoucherReference;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestBookingService implements TestBookingServiceInterface
{
    protected $resource = [
        'voucher_entries.account_ledger',
        'stock_journal.stock_journal_entries.stock_item',
        'stock_journal.stock_journal_entries.job_order',
        'stock_journal.stock_journal_entries.stock_unit',
        'stock_journal.stock_journal_entries.stock_item.stock_category',
        'stock_journal.stock_journal_entries.stock_item.stock_group',
        'voucher_patient.patient.address',
        'voucher_patient.agent',
        'voucher_patient.physician',
        'voucher_references.voucher.voucher_entries'
    ];

    protected $voucherPatientResource = ['agent', 'physician', 'patient.account_ledger', 'voucher'];

    protected $voucherByIdResource = ['voucher_entries', 'voucher_references.voucher.voucher_entries'];

    // This is the list of all bookings for patient only
    public function all_bookings(?string $start_date = null, ?string $end_date = null): Collection
    {
        $userId = Auth::id();
        $query = VoucherPatient::where('created_by', $userId)->with($this->voucherPatientResource);

        if ($start_date && $end_date) {
            $start = Carbon::parse($start_date)->startOfDay();
            $end = Carbon::parse($end_date)->endOfDay();
            $query->whereBetween('created_at', [$start, $end]);
        }
        return $query->get();
    }

    public function test_booking_search($start_date, $end_date): Collection
    {
        $start = Carbon::parse($start_date)->startOfDay();
        $end = Carbon::parse($end_date)->endOfDay();
        return VoucherPatient::with($this->voucherPatientResource)->whereBetween('created_at', [$start, $end])->get();
    }

    public function getAll(): Collection
    {
        // dd(TestBooking::with($this->resource)->get());
        return TestBooking::with($this->resource)->get();
    }

    public function getById(int $id): ?TestBooking
    {
        return TestBooking::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestBooking
    {
        $testBooking = null;
        try {
            DB::beginTransaction();

            $userId = Auth::id();

            $lastJournalId = StockJournal::orderBy('journal_no', 'desc')->value('journal_no');
            $newJournalNo = $lastJournalId ? (string)((int)$lastJournalId + 1) : '1';

            $stockJournal = StockJournal::create([
                'journal_no' => $newJournalNo,
                'journal_date' => Carbon::today()->toDateString(),
                'type' => 'out'
            ]);

            $totalAmount = 0;


            foreach ($data['tests'] as $journalEntry) {
                $stockItem = StockItem::findOrFail($journalEntry['test_id']);

                $discountValue = ($journalEntry['rate'] / 100) * $stockItem->standard_selling_price;

                StockJournalEntry::create([
                    'stock_journal_id' => $stockJournal->id,
                    'stock_item_id' => $stockItem->id,
                    'stock_unit_id' => $stockItem->stock_unit_id,
                    'alternate_unit_id' => $stockItem->stock_unit_id,
                    'start_date' => $journalEntry['test_date'],
                    'end_date' => $journalEntry['report_date'],
                    'unit_ratio' => 1.0,
                    'item_cost' => $stockItem->mrp,
                    'quantity' => 1,
                    'rate' => $stockItem->standard_selling_price,
                    'discount_percentage' => $journalEntry['rate'],
                    'discount_value' => $discountValue,
                    'movement_type' => 'out',
                ]);

                $totalAmount = $totalAmount + $stockItem->standard_selling_price;
            }



            $newVoucherNo = $this->createVoucherNo((int) $data['patient_id']);
            $voucher = TestBooking::create([
                'voucher_no' => $newVoucherNo,
                'voucher_date' => explode('T', $data['booking_date'])[0],
                'voucher_type_id' => 1006,
                'stock_journal_id' => $stockJournal->id
            ]);


            $accountLedger = AccountLedger::where('ledgerable_id', $data['patient_id'])
                ->where('ledgerable_type', 'patient')
                ->firstOrFail();



            VoucherPatient::create([
                'voucher_id' => $voucher->id,
                'patient_id' => $data['patient_id'],
                'agent_id' => $data['agent_id'],
                'physician_id' => $data['physician_id'],
                'sample_collector_id' => $data['sample_collector_id'],
                'discount_type_id' => $data['discount_type_id']
            ]);

            // calaulation of rate and discount
            $discountRate = $data['rate'] === 100 ? 0 : $data['rate'];
            $discountAmount = ($totalAmount * $discountRate) / 100;
            $receivableAmount = $totalAmount - $discountAmount;


            $entryOrder = 1;


            // To Sales A/C
            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => $entryOrder++,
                'account_ledger_id' => 3000001,
                'debit' => 0,
                'credit' => $totalAmount,
                'rate' => 100,
                'calculation_type' => CalculationType::currentTotal->value,
            ]);

            if (!empty($data['discount_type_id']) && $data['discount_type_id'] != 1) {

                VoucherEntry::create([
                    'voucher_id' => $voucher->id,
                    'entry_order' => $entryOrder++,
                    'account_ledger_id' => 4000007,
                    'debit' => $discountAmount,
                    'credit' => 0,
                    'rate' => $data['rate'],
                    'calculation_type' => CalculationType::currentTotal->value,
                ]);
            }

            // By Account Receivable A/C
            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => $entryOrder++,
                'account_ledger_id' => $accountLedger->id,
                'debit' => $receivableAmount,
                'credit' => 0,
                'rate' => 100,
                'calculation_type' => CalculationType::currentTotal->value
            ]);

            $testBooking = TestBooking::find($voucher->id);

            DB::commit();
        } catch (\Exception $e) {
            Log::error('TestBooking store error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            DB::rollBack();
        }


        return $testBooking->load($this->resource);
    }


    public function confirm_payment(array $data): TestBooking
    {
        try {
            DB::beginTransaction();
            $isFirstPayment = !VoucherReference::where("voucher_reference_id", $data['voucher_id'])->exists();
            if (!$isFirstPayment) {
                // checking of total amount code to be written here for validation
            }
            // dd($isFirstPayment);
            $accountLedger = AccountLedger::where('ledgerable_id', $data['patient_id'])
                ->where('ledgerable_type', 'patient')
                ->firstOrFail();

            $lastVoucherNo = Voucher::orderBy('voucher_no', 'desc')->value('voucher_no');
            $newVoucherNo = $lastVoucherNo ? (string)((int)$lastVoucherNo + 1) : '1';

            $voucher = Voucher::create([
                'voucher_no' => $newVoucherNo,
                'voucher_date' => Carbon::today()->toDateString(),
                'voucher_type_id' => 1003,
            ]);

            // Cash A/C
            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => 1,
                'account_ledger_id' => $data['payment_mode'],
                'debit' => $data['amount'],
                'credit' => 0
            ]);

            // To Customer A/C
            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => 2,
                'account_ledger_id' => $accountLedger->id,
                'debit' => 0,
                'credit' => $data['amount']
            ]);

            VoucherReference::create([
                'voucher_id' => $voucher->id,
                'voucher_reference_id' => $data['voucher_id']
            ]);
            // record transaction mode and method
            TransactionInstrument::create([
                'voucher_id' => $voucher->id,
                'payment_mode_id' => $data['payment_mode'],
                'transaction_no' => $data['transaction_no'] ?? null,
                'approved_by' => Auth::id()
            ]);


            $testBooking = TestBooking::with($this->resource)
                ->findOrFail($data['voucher_id']);

            DB::commit();
            return $testBooking;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function post_payment_test_cancellation(): TestBooking
    {
        return TestBooking::create();
    }

    public function createVoucherNo(int $patientId): string
    {
        $patient = Patient::findOrFail($patientId);

        $prefix = strtoupper(substr(preg_replace('/\s+/', '', $patient->name), 0, 3));

        $lastVoucher = Voucher::where('voucher_no', 'like', $prefix . '%')
            ->orderBy('voucher_no', 'desc')
            ->value('voucher_no');

        if ($lastVoucher) {
            $numberPart = (int) preg_replace('/[^0-9]/', '', $lastVoucher);
            $newNumber = str_pad($numberPart + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $prefix . $newNumber;
    }

    public function test_cancellation(array $data, int $id): bool
    {
        try {
            DB::beginTransaction();


            // to find if the requested item is last on the list
            $stockJournalEntry = StockJournalEntry::findOrFail($id);
            /***
             * checking if it is the last item
             * if lastitem == true
             *  then delete the journal entries and voucher entries and post stock journal and voucher as cancelled
             * else
             *  only delete the entries need to be deleted
             */
            $stockJournalEntryLastItem = StockJournalEntry::where('stock_journal_id', '=', $stockJournalEntry->stock_journal_id)->count() == 1;
            // searching for item details need to be removed
            $stockItem = StockItem::findOrFail($stockJournalEntry->stock_item_id);
            // voucher details need to be updated
            $voucher = Voucher::where('stock_journal_id', '=', $stockJournalEntry->stock_journal_id)->first();
            // entries need to be deleted
            $voucherEntries = VoucherEntry::where('voucher_id', '=', $voucher->id)->orderBy('entry_order', 'asc')->get();

            /**
             * if hasDiscount
             *    adjust the discount record too
             */
            $hasDiscount = $voucherEntries->count() == 3;
            // rate of item
            $itemAmount = (int)$stockItem->standard_selling_price;

            // searching for total amount of voucher entered means the total rate of selected items
            $totalCreditAmount = 0;
            foreach ($voucherEntries as $voucherEntry) {
                $totalCreditAmount = $totalCreditAmount + $voucherEntry->credit;
            }


            $remainingTotalAmount = 0;
            $remainingDiscountTotalAmount = 0;
            $oldDiscountAmount = $voucherEntries->firstWhere('account_ledger_id', 4000007)['debit'];
            // calculation of discount again to adjust the balance and discount amount
            $newDiscountAmount = $oldDiscountAmount - ($stockJournalEntry->discount_percentage / 100) * $stockJournalEntry->rate;

            if ($voucherEntries->count() > 2) {
                // calculation of remaining amount with discount and payment not done
                $itemTotalAmount = ($totalCreditAmount - $itemAmount);
                $remainingDiscountTotalAmount = $itemTotalAmount - $oldDiscountAmount;
                $remainingTotalAmount = $totalCreditAmount - $itemAmount;
            } else {
                // calcualtion of remaining amount after test cancelled and payment not done without discount
                $remainingTotalAmount = $totalCreditAmount - $itemAmount;
            }

            // -----------------------voucher / voucher entry updation process started---------------------

            // ------------- voucher update process -------------------
            if ($stockJournalEntryLastItem === true) {
                $userId = Auth::id();
                $voucher->update([
                    'is_cancelled' => true,
                    'cancelled_by' => $userId,
                    'remarks' => $data['remark'] ? $data['remark'] : null
                ]);


                $stockJournal = StockJournal::where('id', '=', $stockJournalEntry->stock_journal_id)->first();
                $stockJournal->update([
                    'is_cancelled' => true,
                    'cancelled_by' => $userId,
                    'cancellation_reason' => $data['remark'] ? $data['remark'] : null
                ]);
            }


            // voucher entries updated
            foreach ($voucherEntries as $voucherEntry) {
                $record = VoucherEntry::findOrFail($voucherEntry->id);
                if ($voucherEntry->entry_order === 1) {
                    $record->update([
                        'credit' => $remainingTotalAmount
                    ]);
                } else if ($hasDiscount && $voucherEntry->entry_order == 2) {
                    $record->update([
                        'debit' => $newDiscountAmount
                    ]);
                } else {
                    $record->update([
                        'debit' => $hasDiscount ? $remainingDiscountTotalAmount : $remainingTotalAmount
                    ]);
                }
            }

            // Stock Journal Entry deleted
            $stockJournalEntry->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::error('Test cancellation error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            DB::rollBack();
            return false;
        }
    }

    public function test_refund_request(array $data, int $id): bool
    {
        try {
            DB::beginTransaction();

            $userId = Auth::id();

            $stockJournalEntry = StockJournalEntry::findOrFail($id);
            $stockParentJournal = StockJournal::where('id', '=', $stockJournalEntry->stock_journal_id)->first();
            $voucher = Voucher::where('stock_journal_id', '=', $stockParentJournal->id)->first();
            $voucherEntries = VoucherEntry::where('voucher_id', '=', $voucher->id)->orderBy('entry_order', 'asc')->get();

            $lastJournalId = StockJournal::orderBy('journal_no', 'desc')->value('journal_no');
            $newJournalNo = $lastJournalId ? (string)((int)$lastJournalId + 1) : '1';



            $stockJournal = StockJournal::create([
                'journal_no' => $newJournalNo,
                'journal_date' => Carbon::today()->toDateString(),
                'type' => 'in',
            ]);

            StockJournalReference::create([
                'stock_journal_id' => $stockJournal->id,
                'stock_journal_reference_id' => $stockParentJournal->id
            ]);


            //  create new entry to record the movement of returned stock
            StockJournalEntry::create([
                'stock_journal_id' => $stockJournal->id,
                'stock_item_id' => $stockJournalEntry->stock_item_id,
                'stock_unit_id' => $stockJournalEntry->stock_unit_id,
                'alternate_unit_id' => $stockJournalEntry->alternate_unit_id,
                'start_date' => $stockJournalEntry->start_date,
                'end_date' => $stockJournalEntry->end_date,
                'unit_ratio' => 1.0,
                'item_cost' => $stockJournalEntry->item_cost,
                'quantity' => 1,
                'rate' => $stockJournalEntry->rate,
                'discount_percentage' => $stockJournalEntry->discount_percentage,
                'discount_value' => $stockJournalEntry->discount_value,
                'is_cancelled' => true,
                'cancelled_by' => $userId,
                'cancellation_reason' => $data['remark'] ?? null,
                'movement_type' => 'in',
            ]);

            // update the item to be cancelled
            $stockJournalEntry->update([
                'is_cancelled' => true,
                'cancelled_by' => $userId,
                'cancellation_reason' => $data['remark'] ?? null
            ]);



            // creating voucher patient with reference
            // search voucher patient first
            $voucherPatient = VoucherPatient::where('voucher_id', '=', $voucher->id)->first();

            // creating voucher no with the help of patient id
            $newVoucherNo = $this->createVoucherNo($voucherPatient->patient_id);
            $newVoucher = TestBooking::create([
                'voucher_no' => $newVoucherNo,
                'voucher_date' => Carbon::today()->toDateString(),
                'voucher_type_id' => 1008,
                'stock_journal_id' => $stockJournal->id,
                'remarks' => $data['remark'] ? $data['remark'] : null,
            ]);


            // voucher reference is used to define th relation of this voucher to previous voucher
            // VoucherReference::create([
            //     'voucher_id' => $newVoucher->id,
            //     'voucher_reference_id' => $voucher->id
            // ]);


            $itemTotalAmount = $stockJournalEntry->rate;
            $itemDiscountAllowed = $stockJournalEntry->discount_percentage ?? 0;
            $discountReturn = ($itemDiscountAllowed / 100) * $itemTotalAmount;
            $totalDiscountedAmount = $itemTotalAmount - $discountReturn;




            $entryOrder = 1;
            $customerLedger = AccountLedger::where('ledgerable_id', $voucherPatient->patient_id)->where('ledgerable_type', 'patient')->firstOrFail();

            // rate in voucher --- confusion

            // Sales Return A/C
            VoucherEntry::create([
                'voucher_id' => $newVoucher->id,
                'entry_order' => $entryOrder++,
                'account_ledger_id' => 3000005,
                'debit' => $itemTotalAmount,
                'credit' => 0,
                'rate' => 100,
                'calculation_type' => CalculationType::currentTotal->value
            ]);

            if ($voucherEntries->count() == 3) {
                VoucherEntry::create([
                    'voucher_id' => $newVoucher->id,
                    'entry_order' => $entryOrder++,
                    'account_ledger_id' => 4000007,
                    'debit' => 0,
                    'credit' => $discountReturn,
                    'rate' => $itemDiscountAllowed,
                    'calculation_type' => CalculationType::currentTotal->value
                ]);
            }

            // To Customer A/C
            VoucherEntry::create([
                'voucher_id' => $newVoucher->id,
                'entry_order' => $entryOrder,
                'account_ledger_id' => $customerLedger->id,
                'debit' => 0,
                'credit' => $totalDiscountedAmount,
                'rate' => $itemDiscountAllowed == 0 ? 100 : 100 - $itemDiscountAllowed,
                'calculation_type' => CalculationType::currentTotal->value
            ]);

            VoucherReference::create([
                'voucher_id' => $newVoucher->id,
                'voucher_reference_id' => $voucher->id
            ]);

            // $jobOrder = JobOrder::where(['voucher_id' => $voucher->id, "stock_journal_entry_id" => $stockJournalEntry->id])->first();

            // $jobOrder->update([
            //     "status" => JobStatus::CancelRequest->value
            // ]);

            // JobOrderHistory::create([
            //     "job_order_id" => $jobOrder->id,
            //     "status" => JobStatus::CancelRequest->value
            // ]);

            // update test cancellation requests
            $testCancellationRequest = TestCancellationRequest::where('stock_journal_entry_id', $id)->first();
            $testCancellationRequest->update([
                'stock_journal_entry_id' => $id,
                'status' => TestCancellation::Approved->value,
                'remarks' => $data['cancellation_remark'],
                'requested_by' => Auth::id()
            ]);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            Log::error('Test Refund error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            DB::rollBack();
            return false;
        }
    }

    public function test_refund_confirm(array $data): TestBooking
    {
        try {
            DB::beginTransaction();


            // calling referenced voucher for amount

            $accountLedger = AccountLedger::where('ledgerable_id', $data['patient_id'])
                ->where('ledgerable_type', 'patient')
                ->firstOrFail();
            $redundAmount = VoucherEntry::where('voucher_id', $data['voucher_id'])->where('account_ledger_id', $accountLedger->id)->first()['credit'];
            $voucherReferenceId = VoucherReference::where('voucher_id', $data['voucher_id'])->first()['voucher_reference_id'];

            $lastVoucherNo = Voucher::orderBy('voucher_no', 'desc')->value('voucher_no');
            $newVoucherNo = $lastVoucherNo ? (string)((int)$lastVoucherNo + 1) : '1';

            $voucher = Voucher::create([
                'voucher_no' => $newVoucherNo,
                'voucher_date' => Carbon::today()->toDateString(),
                'voucher_type_id' => 1002,
            ]);


            // To Customer A/C
            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => 1,
                'account_ledger_id' => $accountLedger->id,
                'debit' => $redundAmount,
                'credit' => 0
            ]);

            // Cash A/C
            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => 2,
                'account_ledger_id' => $data['payment_mode'],
                'debit' => 0,
                'credit' => $redundAmount
            ]);

            VoucherReference::create([
                'voucher_id' => $voucher->id,
                'voucher_reference_id' => $data['voucher_id']
            ]);

            $jobOrder = JobOrder::where('voucher_id', $voucherReferenceId)->where('stock_journal_entry_id', $data['stock_journal_entry_id'])->first();
            $jobOrder->update([
                "status" => JobStatus::Cancelled->value
            ]);
            JobOrderHistory::create([
                'job_order_id' => $jobOrder->id,
                'status' => JobStatus::Cancelled->value,
            ]);
            $testBooking = TestBooking::with($this->resource)
                ->findOrFail($data['voucher_id']);

            DB::commit();
            return $testBooking;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }



    public function update(array $data, int $id): TestBooking
    {
        $record = TestBooking::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestBooking::findOrFail($id);
        return $record->delete();
    }


    // payment processing details
    public function get_voucher_by_id(int $id): TestBooking
    {
        return TestBooking::with($this->voucherByIdResource)->findOrFail($id);
    }
}
