<?php

namespace App\Modules\UniqueQuantityCode\Services;

use App\Modules\UniqueQuantityCode\Contracts\UniqueQuantityCodeServiceInterface;
use App\Modules\UniqueQuantityCode\Models\UniqueQuantityCode;
use Illuminate\Database\Eloquent\Collection;

class UniqueQuantityCodeService implements UniqueQuantityCodeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return UniqueQuantityCode::with($this->resource)->get();
    }

    public function getById(int $id): ?UniqueQuantityCode
    {
        return UniqueQuantityCode::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): UniqueQuantityCode
    {
        return UniqueQuantityCode::create($data);
    }

    public function update(array $data, int $id): UniqueQuantityCode
    {
        $record = UniqueQuantityCode::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = UniqueQuantityCode::findOrFail($id);
        return $record->delete();
    }
}
