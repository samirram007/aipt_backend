<?php

namespace App\Modules\State\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\State\Models\State;

interface StateServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): State;
    public function store(array $data): State;
    public function update(array $data, int $id): State;
    public function delete(int $id): bool;
}
