<?php

namespace App\Modules\StockItemPrice\Services;

use App\Modules\StockItemPrice\Contracts\StockItemPriceServiceInterface;
use App\Modules\StockItemPrice\Models\StockItemPrice;
use Illuminate\Database\Eloquent\Collection;

class StockItemPriceService implements StockItemPriceServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockItemPrice::with($this->resource)->get();
    }

    public function getById(int $id): ?StockItemPrice
    {
        return StockItemPrice::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockItemPrice
    {
        return StockItemPrice::create($data);
    }

    public function update(array $data, int $id): StockItemPrice
    {
        $record = StockItemPrice::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockItemPrice::findOrFail($id);
        return $record->delete();
    }
}
