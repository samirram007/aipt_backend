<?php

namespace App\Modules\Employee\Services;

use App\Modules\Employee\Contracts\EmployeeServiceInterface;
use App\Modules\Employee\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService implements EmployeeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Employee::with($this->resource)->get();
    }

    public function getById(int $id): ?Employee
    {
        return Employee::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Employee
    {
        return Employee::create($data);
    }

    public function update(array $data, int $id): Employee
    {
        $record = Employee::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Employee::findOrFail($id);
        return $record->delete();
    }
}
