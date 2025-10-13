<?php

namespace App\Modules\RoleUser\Services;

use App\Modules\RoleUser\Contracts\RoleUserServiceInterface;
use App\Modules\RoleUser\Models\RoleUser;
use Illuminate\Database\Eloquent\Collection;

class RoleUserService implements RoleUserServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return RoleUser::with($this->resource)->get();
    }

    public function getById(int $id): ?RoleUser
    {
        return RoleUser::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): RoleUser
    {
        return RoleUser::create($data);
    }

    public function update(array $data, int $id): RoleUser
    {
        $record = RoleUser::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = RoleUser::findOrFail($id);
        return $record->delete();
    }
}
