<?php

namespace App\Modules\DayBook\Services;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\DayBook\Contracts\DayBookServiceInterface;
use App\Modules\DayBook\Models\DayBook;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DayBookService implements DayBookServiceInterface
{
    //protected $resource = ['voucher_entries.account_ledger', 'voucher_type', 'company'];
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
            ->whereBetween('voucher_date', [$startDate, $endDate])
            ->get();


        return $vouchers->map(fn(Voucher $voucher) => $this->attachLedgerInfo($voucher));
    }
    public function dayBooksSelf(): Collection
    {
        // $user = auth()->user();
        $userFiscalYear = auth()->user()->user_fiscal_year()->first();
        $startDate = $userFiscalYear->start_date;
        $endDate = $userFiscalYear->end_date;
        if (!$userFiscalYear) {
            throw new \Exception('UserFiscalYear not set for the user.');
        }
        $query = Voucher::with($this->resource)
            ->where('fiscal_year_id', $userFiscalYear->fiscal_year_id)
            ->whereBetween('voucher_date', [$startDate, $endDate])
            ->where('created_by', auth()->id());
        // Log::info('DayBooksSelf Query: ' . $query->toSql() . ' with bindings: ' . implode(', ', $query->getBindings()));

        //dd($userFiscalYear->fiscal_year_id, auth()->id());
        $vouchers = $query->get();
        return $vouchers->map(fn(Voucher $voucher) => $this->attachLedgerInfo($voucher));
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
