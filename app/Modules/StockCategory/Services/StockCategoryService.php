<?php

namespace App\Modules\StockCategory\Services;

use App\Modules\StockCategory\Contracts\StockCategoryServiceInterface;
use App\Modules\StockCategory\Models\StockCategory;
use Illuminate\Database\Eloquent\Collection;

class StockCategoryService implements StockCategoryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return StockCategory::with($this->resource)->get();
    }

    public function getById(int $id): ?StockCategory
    {
        return StockCategory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockCategory
    {
        return StockCategory::create($data);
    }

    public function update(array $data, int $id): StockCategory
    {
        $record = StockCategory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockCategory::findOrFail($id);
        return $record->delete();
    }
}
