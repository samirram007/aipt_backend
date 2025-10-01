<?php

namespace App\Modules\StockUnit\Services;

use App\Modules\StockUnit\Contracts\StockUnitServiceInterface;
use App\Modules\StockUnit\Models\StockUnit;
use Illuminate\Database\Eloquent\Collection;

class StockUnitService implements StockUnitServiceInterface
{
    protected $resource = ['primary_stock_unit', 'secondary_stock_unit', 'unique_quantity_code'];

    public function getAll(): Collection
    {
        return StockUnit::with($this->resource)->get();
    }

    public function getById(int $id): ?StockUnit
    {
        return StockUnit::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockUnit
    {
        return StockUnit::create($data);
    }

    public function update(array $data, int $id): StockUnit
    {
        $record = StockUnit::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockUnit::findOrFail($id);
        return $record->delete();
    }
}
