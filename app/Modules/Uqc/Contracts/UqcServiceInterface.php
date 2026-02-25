<?php

namespace App\Modules\Uqc\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Uqc\Models\Uqc;

interface UqcServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Uqc;
    public function store(array $data): Uqc;
    public function update(array $data, int $id): Uqc;
    public function delete(int $id): bool;
}
