<?php

namespace App\Modules\TestBooking\Services;

use App\Enums\CalculationType;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Patient\Models\Patient;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\TestBooking\Contracts\TestBookingServiceInterface;
use App\Modules\TestBooking\Models\TestBooking;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use App\Modules\VoucherPatient\Models\VoucherPatient;
use App\Modules\VoucherReference\Models\VoucherReference;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
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

    // This is the list of all bookings for patient only
    public function all_bookings(?string $start_date = null, ?string $end_date = null): Collection
    {
        $query = VoucherPatient::with($this->voucherPatientResource);

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
                    'movement_type' => 'out',
                ]);

                $totalAmount = $totalAmount + $stockItem->standard_selling_price;
            }

            $newVoucherNo = $this->createVoucherNo((int) $data['patient_id']);
            $voucher = TestBooking::create([
                'voucher_no' => $newVoucherNo,
                'voucher_date' => Carbon::today()->toDateString(),
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
            $discountRate = $data['rate'] == 100 ? 0 : $data['rate'];
            $discountAmount = ($totalAmount * $discountRate) / 100;
            $cashReceived = $totalAmount - $discountAmount;

            $entryOrder = 1;



            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => $entryOrder++,
                'account_ledger_id' => $accountLedger->id,
                'debit' => 0,
                'credit' => $totalAmount,
                'rate' => 100,
                'calculation_type' => CalculationType::currentTotal->value
            ]);

            if (!empty($data['discount_type_id']) && $data['discount_type_id'] != 1) {
                VoucherEntry::create([
                    'voucher_id' => $voucher->id,
                    'entry_order' => $entryOrder++,
                    'account_ledger_id' => 4000007,
                    'debit' => $discountAmount,
                    'credit' => 0,
                    'rate' => $discountRate,
                    'calculation_type' => CalculationType::currentTotal->value,
                ]);
            }

            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => $entryOrder++,
                'account_ledger_id' => 3000001,
                'debit' => $cashReceived,
                'credit' => 0,
                'rate' => 100 - $discountRate,
                'calculation_type' => CalculationType::currentTotal->value,
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

            $accountLedger = AccountLedger::where('ledgerable_id', $data['patient_id'])
                ->where('ledgerable_type', 'patient')
                ->firstOrFail();

            $lastVoucherNo = Voucher::orderBy('voucher_no', 'desc')->value('voucher_no');
            $newVoucherNo = $lastVoucherNo ? (string)((int)$lastVoucherNo + 1) : '1';

            $voucher = Voucher::create([
                'voucher_no' => $newVoucherNo,
                'voucher_date' => Carbon::today()->toDateString(),
                'voucher_type_id' => 1002,
            ]);

            VoucherEntry::create([
                'voucher_id' => $voucher->id,
                'entry_order' => 1,
                'account_ledger_id' => $data['payment_mode'],
                'debit' => $data['amount'],
                'credit' => 0
            ]);

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

    public function test_cancellation(int $id): bool
    {
        try {
            DB::beginTransaction();
            $stockJournalEntry = StockJournalEntry::findOrFail($id);
            $stockItem = StockItem::findOrFail($stockJournalEntry->stock_item_id);
            $voucher = Voucher::where('stock_journal_id', '=', $stockJournalEntry->stock_journal_id)->first();
            $voucherEntries = VoucherEntry::where('voucher_id', '=', $voucher->id)->orderBy('entry_order', 'asc')->get();


            // calcualtion of total amount by getting the voucher entries
            $itemAmount = (int)$stockItem->standard_selling_price;
            $totalAmount = 0;
            foreach ($voucherEntries as $voucherEntry) {
                $totalAmount = $totalAmount + $voucherEntry->credit;
            }

            // calcualtion of remaining amount after test cancelled and payment not done
            $remainingTotalAmount = $totalAmount - $itemAmount;

            // -----------------------data updation process started---------------------
            // voucher entries updated
            foreach ($voucherEntries as $voucherEntry) {
                $record = VoucherEntry::findOrFail($voucherEntry->id);
                if ($voucherEntry->entry_order === 1) {
                    $record->update([
                        'credit' => $remainingTotalAmount
                    ]);
                } else if ($voucherEntry->entry_order === 2) {
                    $record->update([
                        'debit' => $remainingTotalAmount
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
}
