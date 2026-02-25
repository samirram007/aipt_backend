<?php

namespace App\Modules\StockItemPrice\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockItemPrice\Models\StockItemPrice;

interface StockItemPriceServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockItemPrice;
    public function store(array $data): StockItemPrice;
    public function update(array $data, int $id): StockItemPrice;
    public function delete(int $id): bool;
}
