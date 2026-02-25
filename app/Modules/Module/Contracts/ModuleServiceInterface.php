<?php

namespace App\Modules\Module\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Module\Models\Module;

interface ModuleServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Module;
    public function store(array $data): Module;
    public function update(array $data, int $id): Module;
    public function delete(int $id): bool;
}
