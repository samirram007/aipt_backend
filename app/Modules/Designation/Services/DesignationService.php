<?php

namespace App\Modules\Designation\Services;

use App\Modules\Designation\Contracts\DesignationServiceInterface;
use App\Modules\Designation\Models\Designation;
use Illuminate\Database\Eloquent\Collection;

class DesignationService implements DesignationServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Designation::with($this->resource)->get();
    }

    public function getById(int $id): ?Designation
    {
        return Designation::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Designation
    {
        return Designation::create($data);
    }

    public function update(array $data, int $id): Designation
    {
        $record = Designation::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Designation::findOrFail($id);
        return $record->delete();
    }
}
