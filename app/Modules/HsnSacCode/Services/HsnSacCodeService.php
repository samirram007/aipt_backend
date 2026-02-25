<?php

namespace App\Modules\HsnSacCode\Services;

use App\Modules\HsnSacCode\Contracts\HsnSacCodeServiceInterface;
use App\Modules\HsnSacCode\Models\HsnSacCode;
use Illuminate\Database\Eloquent\Collection;

class HsnSacCodeService implements HsnSacCodeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return HsnSacCode::with($this->resource)->get();
    }

    public function getById(int $id): ?HsnSacCode
    {
        return HsnSacCode::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): HsnSacCode
    {
        return HsnSacCode::create($data);
    }

    public function update(array $data, int $id): HsnSacCode
    {
        $record = HsnSacCode::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = HsnSacCode::findOrFail($id);
        return $record->delete();
    }
}
