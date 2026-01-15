<?php

namespace App\Modules\AmenityCategory\Services;

use App\Modules\AmenityCategory\Contracts\AmenityCategoryServiceInterface;
use App\Modules\AmenityCategory\Models\AmenityCategory;
use Illuminate\Database\Eloquent\Collection;

class AmenityCategoryService implements AmenityCategoryServiceInterface
{
    protected $resource = ['amenities'];

    public function getAll(): Collection
    {
        return AmenityCategory::with($this->resource)->get();
    }

    public function getById(int $id): ?AmenityCategory
    {
        return AmenityCategory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AmenityCategory
    {
        return AmenityCategory::create($data);
    }

    public function update(array $data, int $id): AmenityCategory
    {
        $record = AmenityCategory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AmenityCategory::findOrFail($id);
        return $record->delete();
    }
}
