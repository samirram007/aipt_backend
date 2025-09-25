<?php

namespace App\Modules\FiscalYear\Services;

use App\Modules\FiscalYear\Contracts\FiscalYearServiceInterface;
use App\Modules\FiscalYear\Models\FiscalYear;
use Illuminate\Database\Eloquent\Collection;

class FiscalYearService implements FiscalYearServiceInterface
{
    protected $resource = ['company'];

    public function getAll(): Collection
    {
        return FiscalYear::with($this->resource)->get();
    }

    public function getById(int $id): ?FiscalYear
    {
        return FiscalYear::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): FiscalYear
    {
        return FiscalYear::create($data);
    }

    public function update(array $data, int $id): FiscalYear
    {
        $record = FiscalYear::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = FiscalYear::findOrFail($id);

        return $record->delete();
    }
}
