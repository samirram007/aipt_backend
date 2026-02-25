<?php

namespace App\Modules\SalaryComponent\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\SalaryComponent\Models\SalaryComponent;

interface SalaryComponentServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?SalaryComponent;
    public function store(array $data): SalaryComponent;
    public function update(array $data, int $id): SalaryComponent;
    public function delete(int $id): bool;
}
