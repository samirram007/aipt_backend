<?php

namespace App\Modules\UserRole\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\UserRole\Models\UserRole;

interface UserRoleServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?UserRole;
    public function store(array $data): UserRole;
    public function update(array $data, int $id): UserRole;
    public function delete(int $id): bool;
}
