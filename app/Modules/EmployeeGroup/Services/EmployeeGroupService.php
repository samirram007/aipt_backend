<?php

namespace App\Modules\EmployeeGroup\Services;

use App\Modules\EmployeeGroup\Contracts\EmployeeGroupServiceInterface;
use App\Modules\EmployeeGroup\Models\EmployeeGroup;
use Illuminate\Database\Eloquent\Collection;

class EmployeeGroupService implements EmployeeGroupServiceInterface
{
    protected $resource = ['employees'];

    public function getAll(): Collection
    {
        return EmployeeGroup::with($this->resource)->get();
    }

    public function getById(int $id): ?EmployeeGroup
    {
        return EmployeeGroup::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): EmployeeGroup
    {
        return EmployeeGroup::create($data);
    }

    public function update(array $data, int $id): EmployeeGroup
    {
        $record = EmployeeGroup::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = EmployeeGroup::findOrFail($id);
        return $record->delete();
    }
}
