<?php

namespace App\Modules\Distributor\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Distributor\Models\Distributor;

interface DistributorServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Distributor;
    public function store(array $data): Distributor;
    public function update(array $data, int $id): Distributor;
    public function delete(int $id): bool;
}
