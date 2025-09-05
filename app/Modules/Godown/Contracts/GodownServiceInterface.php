<?php

namespace App\Modules\Godown\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Godown\Models\Godown;

interface GodownServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Godown;
    public function store(array $data): Godown;
    public function update(array $data, int $id): Godown;
    public function delete(int $id): bool;
}
