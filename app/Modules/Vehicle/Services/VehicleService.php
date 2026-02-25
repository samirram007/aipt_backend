<?php

namespace App\Modules\Vehicle\Services;

use App\Modules\Vehicle\Contracts\VehicleServiceInterface;
use App\Modules\Vehicle\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleService implements VehicleServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Vehicle::with($this->resource)->get();
    }

    public function getById(int $id): ?Vehicle
    {
        return Vehicle::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Vehicle
    {
        return Vehicle::create($data);
    }

    public function update(array $data, int $id): Vehicle
    {
        $record = Vehicle::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Vehicle::findOrFail($id);
        return $record->delete();
    }
}
