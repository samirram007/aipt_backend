<?php

namespace App\Modules\StockItemGodown\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockItemGodown\Models\StockItemGodown;

interface StockItemGodownServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockItemGodown;
    public function store(array $data): StockItemGodown;
    public function update(array $data, int $id): StockItemGodown;
    public function delete(int $id): bool;
}
