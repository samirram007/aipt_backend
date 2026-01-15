<?php

namespace App\Modules\FacilityCapitalItem\Services;

use App\Modules\FacilityCapitalItem\Contracts\FacilityCapitalItemServiceInterface;
use App\Modules\FacilityCapitalItem\Models\FacilityCapitalItem;
use Illuminate\Database\Eloquent\Collection;

class FacilityCapitalItemService implements FacilityCapitalItemServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return FacilityCapitalItem::with($this->resource)->get();
    }

    public function getById(int $id): ?FacilityCapitalItem
    {
        return FacilityCapitalItem::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): FacilityCapitalItem
    {
        return FacilityCapitalItem::create($data);
    }

    public function update(array $data, int $id): FacilityCapitalItem
    {
        $record = FacilityCapitalItem::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = FacilityCapitalItem::findOrFail($id);
        return $record->delete();
    }
}
