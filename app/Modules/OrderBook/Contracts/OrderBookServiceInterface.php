<?php

namespace App\Modules\OrderBook\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\OrderBook\Models\OrderBook;

interface OrderBookServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?OrderBook;
    public function store(array $data): OrderBook;
    public function update(array $data, int $id): OrderBook;
    public function delete(int $id): bool;
}
