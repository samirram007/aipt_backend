<?php

namespace App\Modules\CostCategory\Services;

use App\Modules\CostCategory\Contracts\CostCategoryServiceInterface;
use App\Modules\CostCategory\Models\CostCategory;
use Illuminate\Database\Eloquent\Collection;

class CostCategoryService implements CostCategoryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return CostCategory::with($this->resource)->get();
    }

    public function getById(int $id): ?CostCategory
    {
        return CostCategory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): CostCategory
    {
        return CostCategory::create($data);
    }

    public function update(array $data, int $id): CostCategory
    {
        $record = CostCategory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = CostCategory::findOrFail($id);
        return $record->delete();
    }
}
