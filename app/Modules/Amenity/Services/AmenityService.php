<?php

namespace App\Modules\Amenity\Services;

use App\Modules\Amenity\Contracts\AmenityServiceInterface;
use App\Modules\Amenity\Models\Amenity;
use Illuminate\Database\Eloquent\Collection;

class AmenityService implements AmenityServiceInterface
{
    protected $resource = ['amenity_categories'];

    public function getAll(): Collection
    {
        return Amenity::with($this->resource)->get();
    }

    public function getById(int $id): ?Amenity
    {
        return Amenity::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Amenity
    {
        return Amenity::create($data);
    }

    public function update(array $data, int $id): Amenity
    {
        $record = Amenity::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Amenity::findOrFail($id);
        return $record->delete();
    }
}
