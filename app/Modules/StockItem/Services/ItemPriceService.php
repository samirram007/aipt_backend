<?php

namespace App\Modules\StockItem\Services;

use App\Modules\StockItem\Contracts\StockItemServiceInterface;
use App\Modules\StockItem\Models\StockItem;
use Illuminate\Database\Eloquent\Collection;

class ItemPriceService implements StockItemServiceInterface
{
    protected $resource = ['stock_item_prices'];

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
}
