<?php

namespace App\Modules\SalaryComponent\Services;

use App\Modules\SalaryComponent\Contracts\SalaryComponentServiceInterface;
use App\Modules\SalaryComponent\Models\SalaryComponent;
use Illuminate\Database\Eloquent\Collection;

class SalaryComponentService implements SalaryComponentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return SalaryComponent::with($this->resource)->get();
    }

    public function getById(int $id): ?SalaryComponent
    {
        return SalaryComponent::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): SalaryComponent
    {
        return SalaryComponent::create($data);
    }

    public function update(array $data, int $id): SalaryComponent
    {
        $record = SalaryComponent::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = SalaryComponent::findOrFail($id);
        return $record->delete();
    }
}
