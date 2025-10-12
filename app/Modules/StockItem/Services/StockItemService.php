<?php

namespace App\Modules\StockItem\Services;

use App\Modules\StockItem\Contracts\StockItemServiceInterface;
use App\Modules\StockItem\Models\StockItem;
use Illuminate\Database\Eloquent\Collection;

class StockItemService implements StockItemServiceInterface
{
    protected $resource = ['stock_unit', 'alternate_stock_unit'];

    public function getAll(): Collection
    {
        return StockItem::with($this->resource)->get();
    }

    public function getById(int $id): ?StockItem
    {
        return StockItem::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockItem
    {
        //dd($data);
        return StockItem::create($data);
    }

    public function update(array $data, int $id): StockItem
    {
        $record = StockItem::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockItem::findOrFail($id);
        return $record->delete();
    }
    public function getPurchasableStockItems(): Collection
    {
        return StockItem::with($this->resource)->get();
    }
}
