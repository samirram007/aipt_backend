<?php

namespace App\Modules\RoleUser\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\RoleUser\Models\RoleUser;

interface RoleUserServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?RoleUser;
    public function store(array $data): RoleUser;
    public function update(array $data, int $id): RoleUser;
    public function delete(int $id): bool;
}
