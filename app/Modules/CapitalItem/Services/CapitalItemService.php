<?php

namespace App\Modules\CapitalItem\Services;

use App\Modules\CapitalItem\Contracts\CapitalItemServiceInterface;
use App\Modules\CapitalItem\Models\CapitalItem;
use Illuminate\Database\Eloquent\Collection;

class CapitalItemService implements CapitalItemServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return CapitalItem::with($this->resource)->get();
    }

    public function getById(int $id): ?CapitalItem
    {
        return CapitalItem::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): CapitalItem
    {
        return CapitalItem::create($data);
    }

    public function update(array $data, int $id): CapitalItem
    {
        $record = CapitalItem::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = CapitalItem::findOrFail($id);
        return $record->delete();
    }
}
