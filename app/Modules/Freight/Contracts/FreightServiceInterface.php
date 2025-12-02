<?php

namespace App\Modules\Freight\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Freight\Models\Freight;

interface FreightServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Freight;
    public function store(array $data): Freight;
    public function update(array $data, int $id): Freight;
    public function delete(int $id): bool;
}
