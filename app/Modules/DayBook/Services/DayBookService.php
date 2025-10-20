<?php

namespace App\Modules\DayBook\Services;

use App\Modules\DayBook\Contracts\DayBookServiceInterface;
use App\Modules\DayBook\Models\DayBook;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;

class DayBookService implements DayBookServiceInterface
{
    protected $resource = ['voucher_entries.account_ledger', 'voucher_type'];

    public function getAll(): Collection
    {
        $vouchers = Voucher::with($this->resource)->get();
        //dd($vouchers);
        // Optionally map each voucher to include party/transaction detection
        return $vouchers->map(fn($voucher) => $this->attachLedgerInfo($voucher));
    }

    public function getById(int $id): ?DayBook
    {
        return DayBook::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): DayBook
    {
        return DayBook::create($data);
    }

    public function update(array $data, int $id): DayBook
    {
        $record = DayBook::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DayBook::findOrFail($id);
        return $record->delete();
    }


    protected function attachLedgerInfo(Voucher $voucher): Voucher
    {
        // dd($voucher);
        // Detect party ledger (Customer / Supplier)
        // dd($voucher->voucher_entries->first());
        $partyEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->ledgerable_type, ['customer', 'supplier']));
        //dd($partyEntry);
        // Detect transaction ledger using account_group_id
        $purchaseGroupId = 40001; // Purchase group ID
        $salesGroupId = 50001;    // Sales group ID

        $transactionEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->account_group_id, [$purchaseGroupId, $salesGroupId]));

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
                $transactionEntry->account_ledger->only(['id', 'name', 'code', 'ledger_type', 'account_group_id']),
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
