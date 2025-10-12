<?php

namespace App\Modules\SalaryStructure\Services;

use App\Modules\SalaryStructure\Contracts\SalaryStructureServiceInterface;
use App\Modules\SalaryStructure\Models\SalaryStructure;
use Illuminate\Database\Eloquent\Collection;

class SalaryStructureService implements SalaryStructureServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return SalaryStructure::with($this->resource)->get();
    }

    public function getById(int $id): ?SalaryStructure
    {
        return SalaryStructure::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): SalaryStructure
    {
        return SalaryStructure::create($data);
    }

    public function update(array $data, int $id): SalaryStructure
    {
        $record = SalaryStructure::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = SalaryStructure::findOrFail($id);
        return $record->delete();
    }
}
