<?php

namespace App\Modules\Discipline\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Discipline\Models\Discipline;

interface DisciplineServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Discipline;
    public function store(array $data): Discipline;
    public function update(array $data, int $id): Discipline;
    public function delete(int $id): bool;
}
