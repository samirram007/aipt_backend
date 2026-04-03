<?php

namespace App\Modules\DayBook\Services;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\DayBook\Contracts\DayBookServiceInterface;
use App\Modules\DayBook\Models\DayBook;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
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

    public function __construct(protected VoucherServiceInterface $voucherService)
    {
        // You can inject dependencies here if needed
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
            ->whereBetween('voucher_date', [$startDate, $endDate])
            ->get();


        return $vouchers->map(fn(Voucher $voucher) => $this->voucherService->attachLedgerInfo($voucher));
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
        return $vouchers->map(fn(Voucher $voucher) => $this->voucherService->attachLedgerInfo($voucher));
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



}
