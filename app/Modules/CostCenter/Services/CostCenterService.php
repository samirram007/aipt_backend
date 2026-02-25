<?php

namespace App\Modules\CostCenter\Services;

use App\Modules\CostCenter\Contracts\CostCenterServiceInterface;
use App\Modules\CostCenter\Models\CostCenter;
use Illuminate\Database\Eloquent\Collection;

class CostCenterService implements CostCenterServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return CostCenter::with($this->resource)->get();
    }

    public function getById(int $id): ?CostCenter
    {
        return CostCenter::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): CostCenter
    {
        return CostCenter::create($data);
    }

    public function update(array $data, int $id): CostCenter
    {
        $record = CostCenter::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = CostCenter::findOrFail($id);
        return $record->delete();
    }
}
