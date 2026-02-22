<?php

namespace App\Modules\DistributorBook\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\DistributorBook\Models\DistributorBook;

interface DistributorBookServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Collection;
    public function store(array $data): DistributorBook;
    public function update(array $data, int $id): DistributorBook;
    public function delete(int $id): bool;
}
