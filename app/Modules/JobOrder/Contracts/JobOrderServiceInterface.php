<?php

namespace App\Modules\JobOrder\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\JobOrder\Models\JobOrder;

interface JobOrderServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?JobOrder;
    public function store(array $data): JobOrder;
    public function update(array $data, int $id): JobOrder;
    public function delete(int $id): bool;
}
