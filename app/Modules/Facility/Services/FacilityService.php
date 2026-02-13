<?php

namespace App\Modules\Facility\Services;

use App\Modules\Facility\Contracts\FacilityServiceInterface;
use App\Modules\Facility\Models\Facility;
use Illuminate\Database\Eloquent\Collection;

class FacilityService implements FacilityServiceInterface
{
    protected $resource = ['amenities', 'children'];

    public function getAll(): Collection
    {
        $facilities = Facility::whereNull('parent_id')
            ->with(['facilityable', 'children.facilityable', 'children.children.facilityable', 'children.children', 'children.children.children.facilityable', 'amenities', 'amenities.amenity_categories'])
            ->get();
        return $facilities;
        // return Facility::with($this->resource)->get();

    }

    public function getById(int $id): ?Facility
    {
        return Facility::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Facility
    {
        return Facility::create($data);
    }

    public function update(array $data, int $id): Facility
    {
        $record = Facility::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Facility::findOrFail($id);
        return $record->delete();
    }
}
