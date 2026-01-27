<?php

namespace App\Modules\Floor\Services;

use App\Modules\Floor\Contracts\FloorServiceInterface;
use App\Modules\Floor\Models\Floor;
use Illuminate\Database\Eloquent\Collection;

class FloorService implements FloorServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return Floor::with($this->resource)->get();
    }

    public function getById(string $id): ?Floor
    {
        return Floor::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Floor
    {
        return Floor::create($data);
    }

    public function update(array $data, string $id): Floor
    {
        $record = Floor::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Floor::findOrFail($id);
        return $record->delete();
    }
}
