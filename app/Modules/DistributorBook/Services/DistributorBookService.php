<?php

namespace App\Modules\DistributorBook\Services;

use App\Modules\DistributorBook\Contracts\DistributorBookServiceInterface;
use App\Modules\DistributorBook\Models\DistributorBook;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class DistributorBookService implements DistributorBookServiceInterface
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
        'voucher_references',
        'referenced_by'

    ];

    public function __construct(protected VoucherServiceInterface $voucherService)
    {
        // You can inject dependencies here if needed
    }

    public function getAll(): Collection
    {
        $userFiscalYear = auth()->user()->user_fiscal_year()->first();
        $startDate = $userFiscalYear->start_date;
        $endDate = $userFiscalYear->end_date;
        if (!$userFiscalYear) {
            throw new \Exception('UserFiscalYear not set for the user.');
        }

        $totals = VoucherEntry::query()
            ->join('account_ledgers', 'account_ledgers.id', '=', 'voucher_entries.account_ledger_id')
            ->join('vouchers', 'vouchers.id', '=', 'voucher_entries.voucher_id')
            ->select(
                'account_ledgers.id as id',
                'account_ledgers.name as name',
                DB::raw('SUM(voucher_entries.debit) as debit'),
                DB::raw('SUM(voucher_entries.credit) as credit'),
                DB::raw('SUM(voucher_entries.debit - voucher_entries.credit) as net_balance')
            )
            ->where('account_ledgers.ledgerable_type', 'distributor')
            ->where('vouchers.fiscal_year_id', $userFiscalYear->fiscal_year_id)
            ->whereIn('vouchers.voucher_type_id', [1006, 1003])
            ->whereBetween('vouchers.voucher_date', [$startDate, $endDate])
            ->groupBy(
                'account_ledgers.id',
                'account_ledgers.name'
            )
            ->get();

        return $totals;
    }

    public function getById(int $id): ?Collection
    {
        $userFiscalYear = auth()->user()->user_fiscal_year()->first();
        $startDate = $userFiscalYear->start_date;
        $endDate = $userFiscalYear->end_date;
        if (!$userFiscalYear) {
            throw new \Exception('UserFiscalYear not set for the user.');
        }

        $queryBuilder = Voucher::with($this->resource)
            ->join('voucher_entries', 'voucher_entries.voucher_id', '=', 'vouchers.id')
            ->join('account_ledgers', 'account_ledgers.id', '=', 'voucher_entries.account_ledger_id')
            ->where('account_ledgers.ledgerable_type', 'distributor')
            ->where('account_ledgers.id', $id)
            ->where('vouchers.fiscal_year_id', $userFiscalYear->fiscal_year_id)
            ->whereIn('vouchers.voucher_type_id', [2001, 1006, 1003])
            ->whereBetween('vouchers.voucher_date', [$startDate, $endDate])
            ->select('vouchers.*')
            ->distinct();
        // dd($queryBuilder->toSql(), $queryBuilder->getBindings());

        $vouchers = $queryBuilder->orderBy('vouchers.voucher_date', 'asc')->get();//->load($this->resource);
        return $vouchers->map(fn(Voucher $voucher) => $this->voucherService->attachLedgerInfo($voucher));
    }


    public function store(array $data): DistributorBook
    {
        return DistributorBook::create($data);
    }

    public function update(array $data, int $id): DistributorBook
    {
        $record = DistributorBook::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DistributorBook::findOrFail($id);
        return $record->delete();
    }
}
