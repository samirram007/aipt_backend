<?php

namespace App\Modules\StockGroup\Services;

use App\Modules\StockGroup\Contracts\StockGroupServiceInterface;
use App\Modules\StockGroup\Models\StockGroup;
use Illuminate\Database\Eloquent\Collection;

class StockGroupService implements StockGroupServiceInterface
{
    protected $resource = ['parent'];

    public function getAll(): Collection
    {
        return StockGroup::with($this->resource)->get();
    }

    public function getById(int $id): ?StockGroup
    {
        return StockGroup::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockGroup
    {
        return StockGroup::create($data);
    }

    public function update(array $data, int $id): StockGroup
    {
        $record = StockGroup::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StockGroup::findOrFail($id);
        return $record->delete();
    }
}
