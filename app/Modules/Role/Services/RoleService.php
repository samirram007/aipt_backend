<?php

namespace App\Modules\Role\Services;

use App\Modules\Role\Contracts\RoleServiceInterface;
use App\Modules\Role\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService implements RoleServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Role::with($this->resource)->get();
    }

    public function getById(int $id): ?Role
    {
        return Role::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Role
    {
        return Role::create($data);
    }

    public function update(array $data, int $id): Role
    {
        $record = Role::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Role::findOrFail($id);
        return $record->delete();
    }
}
