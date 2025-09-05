<?php

namespace App\Modules\User\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\User\Models\User;

interface UserServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): User;
    public function store(array $data): User;
    public function update(array $data, int $id): User;
    public function delete(int $id): bool;
}
