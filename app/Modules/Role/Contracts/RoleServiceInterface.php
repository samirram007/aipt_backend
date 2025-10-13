<?php

namespace App\Modules\Role\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Role\Models\Role;

interface RoleServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Role;
    public function store(array $data): Role;
    public function update(array $data, int $id): Role;
    public function delete(int $id): bool;
}
