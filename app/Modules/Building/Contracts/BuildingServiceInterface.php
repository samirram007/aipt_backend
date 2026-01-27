<?php

namespace App\Modules\Building\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Building\Models\Building;

interface BuildingServiceInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Building;
    public function store(array $data): Building;
    public function update(array $data, string $id): Building;
    public function delete(int $id): bool;
}
