<?php

namespace App\Modules\PhysicalStock\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PhysicalStock\Models\PhysicalStock;

interface PhysicalStockServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PhysicalStock;
    public function store(array $data): PhysicalStock;
    public function update(array $data, int $id): PhysicalStock;
    public function delete(int $id): bool;
}
