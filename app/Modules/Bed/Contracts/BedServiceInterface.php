<?php

namespace App\Modules\Bed\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Bed\Models\Bed;

interface BedServiceInterface
{
    public function getAll(): Collection;
    public function getById(string $id): ?Bed;
    public function store(array $data): Bed;
    public function update(array $data, string $id): Bed;
    public function delete(int $id): bool;
}
