<?php

namespace App\Modules\Shift\Services;

use App\Modules\Shift\Contracts\ShiftServiceInterface;
use App\Modules\Shift\Models\Shift;
use Illuminate\Database\Eloquent\Collection;

class ShiftService implements ShiftServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Shift::with($this->resource)->get();
    }

    public function getById(int $id): ?Shift
    {
        return Shift::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Shift
    {
        return Shift::create($data);
    }

    public function update(array $data, int $id): Shift
    {
        $record = Shift::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Shift::findOrFail($id);
        return $record->delete();
    }
}
