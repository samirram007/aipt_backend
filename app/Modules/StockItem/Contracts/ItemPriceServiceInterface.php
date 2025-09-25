<?php

namespace App\Modules\StockItem\Contracts;

use App\Modules\StockItem\Models\ItemPrice;
use Illuminate\Database\Eloquent\Collection;


interface ItemPriceServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?ItemPrice;
    public function store(array $data): ItemPrice;
    public function update(array $data, int $id): ItemPrice;
    public function delete(int $id): bool;
}
