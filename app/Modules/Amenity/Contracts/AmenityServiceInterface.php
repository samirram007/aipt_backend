<?php

namespace App\Modules\Amenity\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Amenity\Models\Amenity;

interface AmenityServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Amenity;
    public function store(array $data): Amenity;
    public function update(array $data, int $id): Amenity;
    public function delete(int $id): bool;
}
