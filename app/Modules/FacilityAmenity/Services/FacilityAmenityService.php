<?php

namespace App\Modules\FacilityAmenity\Services;

use App\Modules\FacilityAmenity\Contracts\FacilityAmenityServiceInterface;
use App\Modules\FacilityAmenity\Models\FacilityAmenity;
use Illuminate\Database\Eloquent\Collection;

class FacilityAmenityService implements FacilityAmenityServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return FacilityAmenity::with($this->resource)->get();
    }

    public function getById(int $id): ?FacilityAmenity
    {
        return FacilityAmenity::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): FacilityAmenity
    {
        return FacilityAmenity::create($data);
    }

    public function update(array $data, int $id): FacilityAmenity
    {
        $record = FacilityAmenity::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = FacilityAmenity::findOrFail($id);
        return $record->delete();
    }
}
