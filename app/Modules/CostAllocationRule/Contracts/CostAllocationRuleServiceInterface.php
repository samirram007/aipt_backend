<?php

namespace App\Modules\CostAllocationRule\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\CostAllocationRule\Models\CostAllocationRule;

interface CostAllocationRuleServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?CostAllocationRule;
    public function store(array $data): CostAllocationRule;
    public function update(array $data, int $id): CostAllocationRule;
    public function delete(int $id): bool;
}
