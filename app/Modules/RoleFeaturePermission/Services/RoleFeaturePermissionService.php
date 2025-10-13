<?php

namespace App\Modules\RoleFeaturePermission\Services;

use App\Modules\RoleFeaturePermission\Contracts\RoleFeaturePermissionServiceInterface;
use App\Modules\RoleFeaturePermission\Models\RoleFeaturePermission;
use Illuminate\Database\Eloquent\Collection;

class RoleFeaturePermissionService implements RoleFeaturePermissionServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return RoleFeaturePermission::with($this->resource)->get();
    }

    public function getById(int $id): ?RoleFeaturePermission
    {
        return RoleFeaturePermission::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): RoleFeaturePermission
    {
        return RoleFeaturePermission::create($data);
    }

    public function update(array $data, int $id): RoleFeaturePermission
    {
        $record = RoleFeaturePermission::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = RoleFeaturePermission::findOrFail($id);
        return $record->delete();
    }
}
