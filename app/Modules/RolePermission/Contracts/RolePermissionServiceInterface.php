<?php

namespace App\Modules\RolePermission\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\RolePermission\Models\RolePermission;

interface RolePermissionServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?RolePermission;
    public function store(array $data): RolePermission;
    public function update(array $data, int $id): RolePermission;
    public function delete(int $id): bool;
}
