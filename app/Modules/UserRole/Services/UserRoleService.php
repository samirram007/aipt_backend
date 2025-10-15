<?php

namespace App\Modules\UserRole\Services;

use App\Modules\UserRole\Contracts\UserRoleServiceInterface;
use App\Modules\UserRole\Models\UserRole;
use Illuminate\Database\Eloquent\Collection;

class UserRoleService implements UserRoleServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return UserRole::with($this->resource)->get();
    }

    public function getById(int $id): ?UserRole
    {
        return UserRole::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): UserRole
    {
        return UserRole::create($data);
    }

    public function update(array $data, int $id): UserRole
    {
        $record = UserRole::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = UserRole::findOrFail($id);
        return $record->delete();
    }
}
