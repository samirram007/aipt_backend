<?php

namespace App\Modules\UniqueQuantityCode\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;

interface UniqueQuantityCodeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?UniqueQuantityCode;
    public function store(array $data): UniqueQuantityCode;
    public function update(array $data, int $id): UniqueQuantityCode;
    public function delete(int $id): bool;
}
