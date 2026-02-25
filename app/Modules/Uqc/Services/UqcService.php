<?php

namespace App\Modules\Uqc\Services;

use App\Modules\Uqc\Contracts\UqcServiceInterface;
use App\Modules\Uqc\Models\Uqc;
use Illuminate\Database\Eloquent\Collection;

class UqcService implements UqcServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Uqc::with($this->resource)->get();
    }

    public function getById(int $id): ?Uqc
    {
        return Uqc::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Uqc
    {
        return Uqc::create($data);
    }

    public function update(array $data, int $id): Uqc
    {
        $record = Uqc::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Uqc::findOrFail($id);
        return $record->delete();
    }
}
