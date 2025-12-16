<?php

namespace App\Modules\AccountLedger\Services;

use App\Modules\AccountLedger\Contracts\AccountLedgerServiceInterface;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\User\Models\User;
use App\Modules\UserFiscalYear\Contracts\UserFiscalYearServiceInterface;
use App\Modules\UserFiscalYear\Services\UserFiscalYearService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AccountLedgerService implements AccountLedgerServiceInterface
{

    protected $resource = [
        'account_group.account_nature',
    ];
    protected $ledgerable_resource = [
        'account_group.account_nature',
        'ledgerable.address.state',
        'ledgerable.address.country'
    ];

    protected $userFiscalYearService;
    public function __construct(UserFiscalYearServiceInterface $userFiscalYearService)
    {
        $this->userFiscalYearService = $userFiscalYearService;
    }

    // /**
    //  * Define the resources and their relations to be resolved
    //  *
    //  * @var array<string|array<string,callable>>
    //  */
    // protected $resource = [
    //     'account_group.account_nature', // Simple nested relation
    //     'ledgerable.address' => fn($resolved) => $resolved instanceof \Illuminate\Database\Eloquent\Model
    //         ? $resolved->load(['state', 'country'])
    //         : $resolved, // Transform resolved resource
    // ];
    public function getAll(): Collection
    {
        return AccountLedger::with($this->resource)->get();
    }

    public function getById(int $id): AccountLedger
    {
        return AccountLedger::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AccountLedger
    {
        return AccountLedger::create($data);
    }

    public function update(array $data, int $id): AccountLedger
    {
        // dd($data);
        $record = AccountLedger::findOrFail($id);

        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AccountLedger::findOrFail($id);
        return $record->delete();
    }

    public function getLedgerBalance(int $id): ?array
    {

        $ledger = AccountLedger::with('account_nature')->find($id);
        // dd($ledger->toArray());

        if (!$ledger) {
            return null;
        }

        $balance = $this->calculateLedgerBalance($ledger);
        $nature = strtolower($ledger->account_nature->accounting_effect); // "debit" or "credit"

        // Default (normal behavior)
        $drCr = $nature === 'debit' ? 'DR' : 'CR';

        // If balance is negative → reverse the sign & flip DR/CR
        if ($balance < 0) {
            $balance = $balance ? abs($balance) : 0;
            $drCr = $drCr === 'DR' ? 'CR' : 'DR';
        }

        return [
            'id' => $ledger->id,
            'balance' => $balance,
            'nature' => $drCr,
        ];
    }

    private function calculateLedgerBalance(AccountLedger $ledger): float
    {
        // dd($ledger->toArray());

        $userFiscalYear = $this->userFiscalYearService->getByUserId(auth()->user()->id);

        $totals = $ledger->voucher_entries()
            ->whereHas('voucher', function ($q) use ($userFiscalYear) {
                $q->where('fiscal_year_id', $userFiscalYear->fiscal_year_id);
            })
            ->selectRaw('SUM(debit) as debitTotal, SUM(credit) as creditTotal')
            ->first();
        //dd($userFiscalYear, $ledger->id);
        //     $totals = DB::table('voucher_entries')
        //         ->join('vouchers', 'vouchers.id', '=', 'voucher_entries.voucher_id')
        //         ->where('voucher_entries.account_ledger_id', $ledger->id)
        //         ->where('vouchers.fiscal_year_id', $userFiscalYear->fiscal_year_id)
        //         ->selectRaw('
        //     SUM(voucher_entries.debit) as debitTotal,
        //     SUM(voucher_entries.credit) as creditTotal
        // ')->first();

        //dd($totals);
        return ($totals->debitTotal ?? 0) - ($totals->creditTotal ?? 0);
    }

    public function getPurchaseLedgers(): Collection
    {
        return AccountLedger::with($this->resource)
            ->where('account_group_id', 40004)->orderBy('name')->get();
    }
    public function getSaleLedgers(): Collection
    {
        return AccountLedger::with($this->resource)
            ->where('account_group_id', 30004)->orderBy('name')->get();
    }

    public function getSupplierLedgers(): Collection
    {
        return AccountLedger::with($this->ledgerable_resource)
            ->where('account_group_id', 20003)->orderBy('name')->get();
    }
    public function getDistributorLedgers(): Collection
    {
        return AccountLedger::with($this->ledgerable_resource)
            ->where('account_group_id', 10008)->orderBy('name')->get();
    }
    public function getStockInHandLedgers(): Collection
    {
        return AccountLedger::with($this->resource)
            ->where('account_group_id', 10009)->orderBy('name')->get();
    }
}
