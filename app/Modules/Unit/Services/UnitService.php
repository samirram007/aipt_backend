<?php

namespace App\Modules\Unit\Services;

use App\Modules\Unit\Contracts\UnitServiceInterface;
use App\Modules\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Collection;

class UnitService implements UnitServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Unit::with($this->resource)->get();
    }

    public function getById(int $id): ?Unit
    {
        return Unit::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Unit
    {
        return Unit::create($data);
    }

    public function update(array $data, int $id): Unit
    {
        $record = Unit::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Unit::findOrFail($id);
        return $record->delete();
    }
}
