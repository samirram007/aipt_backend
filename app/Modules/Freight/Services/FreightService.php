<?php

namespace App\Modules\Freight\Services;

use App\Modules\Freight\Contracts\FreightServiceInterface;
use App\Modules\Freight\Models\Freight;
use Illuminate\Database\Eloquent\Collection;

class FreightService implements FreightServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Freight::with($this->resource)->get();
    }

    public function getById(int $id): ?Freight
    {
        return Freight::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Freight
    {
        return Freight::create($data);
    }

    public function update(array $data, int $id): Freight
    {
        $record = Freight::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Freight::findOrFail($id);
        return $record->delete();
    }
}
