<?php

namespace App\Modules\Bed\Services;

use App\Modules\Bed\Contracts\BedServiceInterface;
use App\Modules\Bed\Models\Bed;
use Illuminate\Database\Eloquent\Collection;

class BedService implements BedServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return Bed::with($this->resource)->get();
    }

    public function getById(string $id): ?Bed
    {
        return Bed::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Bed
    {
        return Bed::create($data);
    }

    public function update(array $data, string $id): Bed
    {
        $record = Bed::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Bed::findOrFail($id);
        return $record->delete();
    }
}
