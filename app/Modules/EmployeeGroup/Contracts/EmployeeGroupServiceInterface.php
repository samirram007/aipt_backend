<?php

namespace App\Modules\EmployeeGroup\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\EmployeeGroup\Models\EmployeeGroup;

interface EmployeeGroupServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?EmployeeGroup;
    public function store(array $data): EmployeeGroup;
    public function update(array $data, int $id): EmployeeGroup;
    public function delete(int $id): bool;
}
