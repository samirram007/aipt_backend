<?php
namespace App\Modules\ReceiptVoucher\Services;

use App\Modules\ReceiptVoucher\Contracts\ReceiptVoucherServiceInterface;
use App\Modules\ReceiptVoucher\Models\ReceiptVoucher;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\Voucher\Requests\VoucherRequest;
use App\Modules\VoucherReference\Models\VoucherReference;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Validator;

class ReceiptVoucherService implements ReceiptVoucherServiceInterface
{
    protected $resource = [
        'voucher_type',
        'voucher_entries.account_ledger',
        'stock_journal.stock_journal_entries.rate_unit',
        'stock_journal.stock_journal_entries.stock_item.stock_unit',
        'stock_journal.stock_journal_entries.stock_item.alternate_stock_unit',
        'stock_journal.stock_journal_entries.alternate_unit',
        'stock_journal.stock_journal_entries.stock_journal_godown_entries.godown',
        'voucher_party.state',
        'voucher_party.country',
        'voucher_dispatch_detail',
        'company',
        'fiscal_year',
    ];
    public function __construct(protected VoucherServiceInterface $voucherService)
    {
        // $this->resource = ['partyLedger', 'transactionLedger'];
    }
    public function getAll(): Collection
    {
        // $user = auth()->user();
        $userFiscalYear = auth()->user()->user_fiscal_year()->first();
        $startDate = $userFiscalYear->start_date;
        $endDate = $userFiscalYear->end_date;
        if (!$userFiscalYear) {
            throw new \Exception('UserFiscalYear not set for the user.');
        }
        $vouchers = Voucher::with($this->resource)
            ->where('fiscal_year_id', $userFiscalYear->fiscal_year_id)
            ->where('voucher_type_id', 1003) // Assuming 1003 is the ID for Receipt Voucher type
            ->whereBetween('voucher_date', [$startDate, $endDate])
            ->get();

        //dd($vouchers->toArray());
        // Optionally map each voucher to include party/transaction detection
        return $vouchers->map(fn(Voucher $voucher) => $this->attachLedgerInfo($voucher));
    }




    public function getById(int $id): ?ReceiptVoucher
    {
        return ReceiptVoucher::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): ReceiptVoucher
    {
        return ReceiptVoucher::create($data);
    }

    public function update(array $data, int $id): ReceiptVoucher
    {
        $record = ReceiptVoucher::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = ReceiptVoucher::findOrFail($id);
        return $record->delete();
    }
    public function getFreightReceiptByFreightId(int $freight_id): Collection
    {
        $paymentVouchersIds = VoucherReference::where('ref_voucher_id', $freight_id)
            ->where('type', 'freight_payment')
            ->pluck('voucher_id');
        if ($paymentVouchersIds->isEmpty()) {
            return collect(); // Return an empty collection if no payment vouchers found
        }
        $receiptVoucher = $this->voucherService->getAll()->whereIn('id', $paymentVouchersIds)->where('voucher_type_id', 1003);

        // dd($receiptVoucher);
        return $receiptVoucher;

        //  return ReceiptVoucher::with($this->resource)->where('freight_id', $freight_id)->get();
    }
    public function storeFreightReceiptVoucher(array $data): Voucher
    {
        try {
            // return $this->voucherService->storeFreightReceiptVoucher($data);


            $refVoucherId = $data['freight_id'] ?? null;
            $paymentVoucher = VoucherReference::where('ref_voucher_id', $refVoucherId)
                ->where('type', 'freight_payment')
                ->first();



            $refVoucherData = [
                'ref_voucher_id' => $refVoucherId,
                'type' => 'freight_payment',
            ];
            //   dd($refVoucherData);
            //voucher create
            $voucherEntries = [
                [
                    'entry_order' => 1,
                    'account_ledger_id' => $data['transaction_ledger_id'],
                    'debit' => $data['amount'],
                    'credit' => 0,
                ],
                [
                    'entry_order' => 2,
                    'account_ledger_id' => $data['party_ledger_id'],
                    'debit' => 0,
                    'credit' => $data['amount'],
                ],
            ];
            $entryData = [
                'voucher_type_id' => 1003,
                'voucher_date' => $data['receipt_date'] ?? date('Y-m-d'),
                'module' => 'receipt_voucher',
                'remarks' => $data['remark'] ?? null,
                'effects_account' => true,
                'effects_stock' => false,
                'is_effecting' => true,
                'voucher_entries' => $voucherEntries,
                'voucher_reference' => $refVoucherData,
            ];
            //dd($voucherData);
            //dd($entryData);
            $rules = (new VoucherRequest())->rules();
            $validatedEntry = Validator::make($entryData, $rules)->validate();
            //  dd($validatedEntry);
            $receiptVoucher = $this->voucherService->store($validatedEntry);
            // \Log::info('Freight receipt voucher created successfully', ['voucher_id' => $receiptVoucher->id]);
            //  throw new \Exception('No associated freight payment voucher found for the given freight_id.');
            //Logger::info('Freight receipt voucher created successfully', ['voucher_id' => $receiptVoucher->id]);
            return $receiptVoucher;

        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            //  \Log::error('Failed to create freight receipt voucher: ' . $e->getMessage());
            throw new \Exception('Failed to create freight receipt voucher: ' . $e->getMessage());
        }


    }


    protected function attachLedgerInfo(Voucher $voucher): Voucher
    {
        // dd($voucher);
        // Detect party ledger (Customer / Supplier)
        // dd($voucher->voucher_entries->first());
        $partyEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->ledgerable_type, ['customer', 'supplier', 'distributor', 'transporter']));
        //dd($partyEntry);
        // Detect transaction ledger using account_group_id
        $purchaseGroupId = 40001; // Purchase group ID
        $salesGroupId = 50001;    // Sales group ID
        $stockGroupId = 10009;    // Stock group ID

        $transactionEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->account_group_id, [$purchaseGroupId, $salesGroupId, $stockGroupId]));

        // Calculate current balance for party ledger
        $partyCurrentBalance = $partyEntry?->account_ledger
            ? $partyEntry->account_ledger->voucher_entries()->sum('debit') - $partyEntry->account_ledger->voucher_entries()->sum('credit')
            : 0;
        // dd($partyCurrentBalance);
        // Calculate current balance for transaction ledger
        $transactionCurrentBalance = $transactionEntry?->account_ledger
            ? $transactionEntry->account_ledger->voucher_entries()->sum('debit') -
            $transactionEntry->account_ledger->voucher_entries()->sum('credit')
            : 0;
        // dd($transactionEntry->account_ledger->voucher_entries()->sum('credit'));
        // Attach full ledger objects with current balance


        $voucher->setRelation(
            'party_ledger',
            $partyEntry?->account_ledger
            ? array_merge(
                $partyEntry->account_ledger->only(['id', 'name', 'code', 'ledgerable_type', 'ledgerable_id']),
                ['current_balance' => $partyCurrentBalance]
            )
            : null
        );

        $voucher->setRelation(
            'transaction_ledger',
            $transactionEntry?->account_ledger
            ? array_merge(
                $transactionEntry->account_ledger->only(['id', 'name', 'code', 'account_group_id']),
                ['current_balance' => $transactionCurrentBalance]
            )
            : null
        );
        // $voucher->transaction_ledger['current_balance'] = $transactionCurrentBalance;
        // dd($voucher);
        // Attach voucher amount (total debit or credit)
        $voucher->amount = $voucher->voucher_entries->sum(fn($entry) => $entry->debit ?: $entry->credit ?: 0);

        return $voucher;
    }
}
