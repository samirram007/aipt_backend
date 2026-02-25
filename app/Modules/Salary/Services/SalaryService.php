<?php

namespace App\Modules\Salary\Services;

use App\Modules\Salary\Contracts\SalaryServiceInterface;
use App\Modules\Salary\Models\Salary;
use Illuminate\Database\Eloquent\Collection;

class SalaryService implements SalaryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Salary::with($this->resource)->get();
    }

    public function getById(int $id): ?Salary
    {
        return Salary::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Salary
    {
        return Salary::create($data);
    }

    public function update(array $data, int $id): Salary
    {
        $record = Salary::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Salary::findOrFail($id);
        return $record->delete();
    }
}
