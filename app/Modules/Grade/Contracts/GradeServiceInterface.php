<?php

namespace App\Modules\Grade\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Grade\Models\Grade;

interface GradeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Grade;
    public function store(array $data): Grade;
    public function update(array $data, int $id): Grade;
    public function delete(int $id): bool;
}
