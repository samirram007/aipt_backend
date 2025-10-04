<?php

namespace App\Modules\Physician\Services;

use App\Modules\Physician\Contracts\PhysicianServiceInterface;
use App\Modules\Physician\Models\Physician;
use Illuminate\Database\Eloquent\Collection;

class PhysicianService implements PhysicianServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Physician::with($this->resource)->get();
    }

    public function getById(int $id): ?Physician
    {
        return Physician::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Physician
    {
        return Physician::create($data);
    }

    public function update(array $data, int $id): Physician
    {
        $record = Physician::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Physician::findOrFail($id);
        return $record->delete();
    }
}
