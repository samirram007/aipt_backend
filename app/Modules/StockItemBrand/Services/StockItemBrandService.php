<?php

namespace App\Modules\StockItemBrand\Services;

use App\Modules\StockItemBrand\Contracts\StockItemBrandServiceInterface;
use App\Modules\StockItemBrand\Models\StockItemBrand;
use Illuminate\Database\Eloquent\Collection;

class StockItemBrandService implements StockItemBrandServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockItemBrand::with($this->resource)->get();
    }

    public function getById(int $id): ?StockItemBrand
    {
        return StockItemBrand::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockItemBrand
    {
        return StockItemBrand::create($data);
    }

    public function update(array $data, int $id): StockItemBrand
    {
        $record = StockItemBrand::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockItemBrand::findOrFail($id);
        return $record->delete();
    }
}
