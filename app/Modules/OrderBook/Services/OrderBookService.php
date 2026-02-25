<?php

namespace App\Modules\OrderBook\Services;

use App\Modules\OrderBook\Contracts\OrderBookServiceInterface;
use App\Modules\OrderBook\Models\OrderBook;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;

class OrderBookService implements OrderBookServiceInterface
{
    protected $resource=['voucher_type',
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
        'fiscal_year',];

    public function getAll(): Collection
    {

        $vouchers = Voucher::with($this->resource)->whereIn('voucher_type_id',[5001,5002])->orderBy('created_at', 'desc')->get();


        // dd('OrderBookService getAll called');
    // return OrderBook::with($this->resource)->get();
        //  $vouchers = Voucher::with($this->resource)->get();

        //  dd($vouchers);
        //dd($vouchers);
        // Optionally map each voucher to include party/transaction detection
        return $vouchers->map(fn($voucher) => $this->attachLedgerInfo($voucher));
    }

    public function getById(int $id): ?OrderBook
    {
        return OrderBook::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): OrderBook
    {
        return OrderBook::create($data);
    }

    public function update(array $data, int $id): OrderBook
    {
        $record = OrderBook::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = OrderBook::findOrFail($id);
        return $record->delete();
    }

    protected function attachLedgerInfo(Voucher $voucher): Voucher
    {
        // dd($voucher);
        // Detect party ledger (Customer / Supplier)
        // dd($voucher->voucher_entries->first());
        $partyEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->ledgerable_type, ['customer', 'supplier', 'distributor']));
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
