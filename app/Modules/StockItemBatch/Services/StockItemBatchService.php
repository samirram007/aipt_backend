<?php

namespace App\Modules\StockItemBatch\Services;

use App\Modules\StockItemBatch\Contracts\StockItemBatchServiceInterface;
use App\Modules\StockItemBatch\Models\StockItemBatch;
use Illuminate\Database\Eloquent\Collection;

class StockItemBatchService implements StockItemBatchServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockItemBatch::with($this->resource)->get();
    }

    public function getById(int $id): ?StockItemBatch
    {
        return StockItemBatch::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockItemBatch
    {
        return StockItemBatch::create($data);
    }

    public function update(array $data, int $id): StockItemBatch
    {
        $record = StockItemBatch::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockItemBatch::findOrFail($id);
        return $record->delete();
    }
}
