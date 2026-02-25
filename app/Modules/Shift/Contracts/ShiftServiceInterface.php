<?php

namespace App\Modules\Shift\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Shift\Models\Shift;

interface ShiftServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Shift;
    public function store(array $data): Shift;
    public function update(array $data, int $id): Shift;
    public function delete(int $id): bool;
}
