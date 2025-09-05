<?php

namespace App\Modules\AccountLedger\Services;

use App\Modules\AccountLedger\Contracts\AccountLedgerServiceInterface;
use App\Modules\AccountLedger\Models\AccountLedger;
use Illuminate\Database\Eloquent\Collection;

class AccountLedgerService implements AccountLedgerServiceInterface
{
    protected $resource = ['account_group.account_nature'];
    public function getAll(): Collection
    {
        return AccountLedger::with($this->resource)->get();
    }

    public function getById(int $id): AccountLedger
    {
        return AccountLedger::findOrFail($id);
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
}
