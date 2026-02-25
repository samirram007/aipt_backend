<?php

namespace App\Modules\Vehicle\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Vehicle\Models\Vehicle;

interface VehicleServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Vehicle;
    public function store(array $data): Vehicle;
    public function update(array $data, int $id): Vehicle;
    public function delete(int $id): bool;
}
