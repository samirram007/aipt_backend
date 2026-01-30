<?php

namespace App\Modules\UserFiscalYear\Services;

use App\Modules\UserFiscalYear\Contracts\UserFiscalYearServiceInterface;
use App\Modules\UserFiscalYear\Models\UserFiscalYear;
use Illuminate\Database\Eloquent\Collection;

class UserFiscalYearService implements UserFiscalYearServiceInterface
{
    protected $resource = ['user', 'fiscal_year.company'];

    public function getAll(): Collection
    {
        return UserFiscalYear::with($this->resource)->get();
    }

    public function getById(int $id): ?UserFiscalYear
    {
        return UserFiscalYear::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): UserFiscalYear
    {

        return UserFiscalYear::create($data);
    }

    public function update(array $data, int $id): UserFiscalYear
    {
        $record = UserFiscalYear::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function saveReportingPeriod(array $data): UserFiscalYear
    {
        $userId = auth()->id();
        $record = UserFiscalYear::where('user_id', $userId)->first();

        if (!$record) {
            throw new \Exception('Reporting period cannot be set. UserFiscalYear not found for the user.');
        }

        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = UserFiscalYear::findOrFail($id);
        return $record->delete();
    }

    public function getByUserId(int $userId): ?UserFiscalYear
    {
        return UserFiscalYear::with($this->resource)->where('user_id', $userId)->first();
    }
}
