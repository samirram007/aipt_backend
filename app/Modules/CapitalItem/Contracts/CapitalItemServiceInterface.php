<?php

namespace App\Modules\CapitalItem\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\CapitalItem\Models\CapitalItem;

interface CapitalItemServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?CapitalItem;
    public function store(array $data): CapitalItem;
    public function update(array $data, int $id): CapitalItem;
    public function delete(int $id): bool;
}
