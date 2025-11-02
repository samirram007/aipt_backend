<?php

namespace App\Modules\DiscountType\Services;

use App\Modules\DiscountType\Contracts\DiscountTypeServiceInterface;
use App\Modules\DiscountType\Models\DiscountType;
use Illuminate\Database\Eloquent\Collection;

class DiscountTypeService implements DiscountTypeServiceInterface
{
    protected $resource=['account_ledger'];

    public function getAll(): Collection
    {
        return DiscountType::with($this->resource)->get();
    }

    public function getById(int $id): ?DiscountType
    {
        return DiscountType::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): DiscountType
    {
        return DiscountType::create($data);
    }

    public function update(array $data, int $id): DiscountType
    {
        $record = DiscountType::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = DiscountType::findOrFail($id);
        return $record->delete();
    }
}
