<?php

namespace App\Modules\Grade\Services;

use App\Modules\Grade\Contracts\GradeServiceInterface;
use App\Modules\Grade\Models\Grade;
use Illuminate\Database\Eloquent\Collection;

class GradeService implements GradeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Grade::with($this->resource)->get();
    }

    public function getById(int $id): ?Grade
    {
        return Grade::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Grade
    {
        return Grade::create($data);
    }

    public function update(array $data, int $id): Grade
    {
        $record = Grade::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Grade::findOrFail($id);
        return $record->delete();
    }
}
