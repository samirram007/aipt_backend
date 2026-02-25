<?php

namespace App\Modules\CostCategory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\CostCategory\Models\CostCategory;

interface CostCategoryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?CostCategory;
    public function store(array $data): CostCategory;
    public function update(array $data, int $id): CostCategory;
    public function delete(int $id): bool;
}
