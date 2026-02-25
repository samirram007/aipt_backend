<?php

namespace App\Modules\AccountingPeriod\Services;

use App\Modules\AccountingPeriod\Contracts\AccountingPeriodServiceInterface;
use App\Modules\AccountingPeriod\Models\AccountingPeriod;
use Illuminate\Database\Eloquent\Collection;

class AccountingPeriodService implements AccountingPeriodServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return AccountingPeriod::with($this->resource)->get();
    }

    public function getById(int $id): ?AccountingPeriod
    {
        return AccountingPeriod::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AccountingPeriod
    {
        return AccountingPeriod::create($data);
    }

    public function update(array $data, int $id): AccountingPeriod
    {
        $record = AccountingPeriod::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AccountingPeriod::findOrFail($id);
        return $record->delete();
    }
}
