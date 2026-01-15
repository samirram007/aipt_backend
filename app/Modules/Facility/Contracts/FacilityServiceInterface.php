<?php

namespace App\Modules\Facility\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Facility\Models\Facility;

interface FacilityServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Facility;
    public function store(array $data): Facility;
    public function update(array $data, int $id): Facility;
    public function delete(int $id): bool;
}
