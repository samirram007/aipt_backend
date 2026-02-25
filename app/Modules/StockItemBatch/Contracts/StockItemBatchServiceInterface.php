<?php

namespace App\Modules\StockItemBatch\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockItemBatch\Models\StockItemBatch;

interface StockItemBatchServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockItemBatch;
    public function store(array $data): StockItemBatch;
    public function update(array $data, int $id): StockItemBatch;
    public function delete(int $id): bool;
}
