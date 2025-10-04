<?php

namespace App\Modules\StockItemSerial\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockItemSerial\Models\StockItemSerial;

interface StockItemSerialServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockItemSerial;
    public function store(array $data): StockItemSerial;
    public function update(array $data, int $id): StockItemSerial;
    public function delete(int $id): bool;
}
