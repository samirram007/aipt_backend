<?php

namespace App\Modules\RoleFeaturePermission\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\RoleFeaturePermission\Models\RoleFeaturePermission;

interface RoleFeaturePermissionServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?RoleFeaturePermission;
    public function store(array $data): RoleFeaturePermission;
    public function update(array $data, int $id): RoleFeaturePermission;
    public function delete(int $id): bool;
}
