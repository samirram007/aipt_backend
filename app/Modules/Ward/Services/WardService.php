<?php

namespace App\Modules\Ward\Services;

use App\Modules\Ward\Contracts\WardServiceInterface;
use App\Modules\Ward\Models\Ward;
use Illuminate\Database\Eloquent\Collection;

class WardService implements WardServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Ward::with($this->resource)->get();
    }

    public function getById(int $id): ?Ward
    {
        return Ward::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Ward
    {
        return Ward::create($data);
    }

    public function update(array $data, int $id): Ward
    {
        $record = Ward::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Ward::findOrFail($id);
        return $record->delete();
    }
}
