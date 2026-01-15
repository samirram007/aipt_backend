<?php

namespace App\Modules\FacilityAmenity\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\FacilityAmenity\Models\FacilityAmenity;

interface FacilityAmenityServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?FacilityAmenity;
    public function store(array $data): FacilityAmenity;
    public function update(array $data, int $id): FacilityAmenity;
    public function delete(int $id): bool;
}
