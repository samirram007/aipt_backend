<?php

namespace App\Modules\Bom\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Bom\Models\Bom;

interface BomServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Bom;
    public function store(array $data): Bom;
    public function update(array $data, int $id): Bom;
    public function delete(int $id): bool;
    public function getBomByStockItemId(int $stockItemId): Collection;
}
