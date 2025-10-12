<?php

namespace App\Modules\CostAllocationRule\Services;

use App\Modules\CostAllocationRule\Contracts\CostAllocationRuleServiceInterface;
use App\Modules\CostAllocationRule\Models\CostAllocationRule;
use Illuminate\Database\Eloquent\Collection;

class CostAllocationRuleService implements CostAllocationRuleServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return CostAllocationRule::with($this->resource)->get();
    }

    public function getById(int $id): ?CostAllocationRule
    {
        return CostAllocationRule::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): CostAllocationRule
    {
        return CostAllocationRule::create($data);
    }

    public function update(array $data, int $id): CostAllocationRule
    {
        $record = CostAllocationRule::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = CostAllocationRule::findOrFail($id);
        return $record->delete();
    }
}
