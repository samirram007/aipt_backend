<?php

namespace App\Modules\AccountNature\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\AccountNature\Models\AccountNature;

interface AccountNatureServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?AccountNature;
    public function store(array $data): AccountNature;
    public function update(array $data, int $id): AccountNature;
    public function delete(int $id): bool;
}
