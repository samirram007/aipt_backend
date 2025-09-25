<?php

namespace App\Modules\Employee\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Employee\Models\Employee;

interface EmployeeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Employee;
    public function store(array $data): Employee;
    public function update(array $data, int $id): Employee;
    public function delete(int $id): bool;
}
