<?php

namespace App\Modules\Building\Services;

use App\Modules\Building\Contracts\BuildingServiceInterface;
use App\Modules\Building\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class BuildingService implements BuildingServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return Building::with($this->resource)->get();
    }

    public function getById(string $id): ?Building
    {
        return Building::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Building
    {
        return Building::create($data);
    }

    public function update(array $data, string $id): Building
    {
        $record = Building::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Building::findOrFail($id);
        return $record->delete();
    }
}
