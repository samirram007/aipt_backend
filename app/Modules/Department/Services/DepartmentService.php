<?php

namespace App\Modules\Department\Services;

use App\Modules\Department\Contracts\DepartmentServiceInterface;
use App\Modules\Department\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class DepartmentService implements DepartmentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Department::with($this->resource)->get();
    }

    public function getById(int $id): ?Department
    {
        return Department::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Department
    {
        return Department::create($data);
    }

    public function update(array $data, int $id): Department
    {
        $record = Department::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Department::findOrFail($id);
        return $record->delete();
    }
}
