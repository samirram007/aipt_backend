<?php

namespace App\Modules\Unit\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Unit\Models\Unit;

interface UnitServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Unit;
    public function store(array $data): Unit;
    public function update(array $data, int $id): Unit;
    public function delete(int $id): bool;
}
