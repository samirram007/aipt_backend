<?php

namespace App\Modules\Discipline\Services;

use App\Modules\Discipline\Contracts\DisciplineServiceInterface;
use App\Modules\Discipline\Models\Discipline;
use Illuminate\Database\Eloquent\Collection;

class DisciplineService implements DisciplineServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Discipline::with($this->resource)->get();
    }

    public function getById(int $id): ?Discipline
    {
        return Discipline::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Discipline
    {
        return Discipline::create($data);
    }

    public function update(array $data, int $id): Discipline
    {
        $record = Discipline::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Discipline::findOrFail($id);
        return $record->delete();
    }
}
