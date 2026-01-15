<?php

namespace App\Modules\AmenityCategory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\AmenityCategory\Models\AmenityCategory;

interface AmenityCategoryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?AmenityCategory;
    public function store(array $data): AmenityCategory;
    public function update(array $data, int $id): AmenityCategory;
    public function delete(int $id): bool;
}
