<?php

namespace App\Modules\RolePermission\Services;

use App\Modules\RolePermission\Contracts\RolePermissionServiceInterface;
use App\Modules\RolePermission\Models\RolePermission;
use Illuminate\Database\Eloquent\Collection;

class RolePermissionService implements RolePermissionServiceInterface
{
    protected $resource = ['role', 'feature.module'];

    public function getAll(): Collection
    {
        return RolePermission::with($this->resource)->get();
    }

    public function getById(int $id): ?RolePermission
    {
        return RolePermission::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): RolePermission
    {
        return RolePermission::create($data);
    }

    public function update(array $data, int $id): RolePermission
    {
        $record = RolePermission::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = RolePermission::findOrFail($id);
        return $record->delete();
    }
}
