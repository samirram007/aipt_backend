<?php

namespace App\Modules\Physician\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Physician\Models\Physician;

interface PhysicianServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Physician;
    public function store(array $data): Physician;
    public function update(array $data, int $id): Physician;
    public function delete(int $id): bool;
}
