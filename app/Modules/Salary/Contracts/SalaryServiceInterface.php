<?php

namespace App\Modules\Salary\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Salary\Models\Salary;

interface SalaryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Salary;
    public function store(array $data): Salary;
    public function update(array $data, int $id): Salary;
    public function delete(int $id): bool;
}
