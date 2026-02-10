<?php

namespace App\Modules\DocumentUser\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\DocumentUser\Models\DocumentUser;

interface DocumentUserServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?DocumentUser;
    public function store(array $data): DocumentUser;
    public function update(array $data, int $id): DocumentUser;
    public function delete(int $id): bool;
}
