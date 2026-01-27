<?php

namespace App\Modules\StorageUnit\Services;

use App\Modules\StorageUnit\Contracts\StorageUnitServiceInterface;
use App\Modules\StorageUnit\Models\StorageUnit;
use Illuminate\Database\Eloquent\Collection;

class StorageUnitService implements StorageUnitServiceInterface
{
    protected $resource = ['parent', 'capacity_unit', 'address'];

    public function getAll(): Collection
    {
        return StorageUnit::with($this->resource)->get();
    }

    public function getById(int $id): ?StorageUnit
    {
        return StorageUnit::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StorageUnit
    {
        return StorageUnit::create($data);
    }

    public function update(array $data, int $id): StorageUnit
    {
        $record = StorageUnit::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = StorageUnit::findOrFail($id);
        return $record->delete();
    }
}
