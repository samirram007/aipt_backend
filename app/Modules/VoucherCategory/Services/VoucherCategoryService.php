<?php

namespace App\Modules\VoucherCategory\Services;

use App\Modules\VoucherCategory\Contracts\VoucherCategoryServiceInterface;
use App\Modules\VoucherCategory\Models\VoucherCategory;
use Illuminate\Database\Eloquent\Collection;

class VoucherCategoryService implements VoucherCategoryServiceInterface
{
    protected $resource = ['voucher_types'];

    public function getAll(): Collection
    {
        return VoucherCategory::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherCategory
    {
        return VoucherCategory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherCategory
    {
        return VoucherCategory::create($data);
    }

    public function update(array $data, int $id): VoucherCategory
    {
        $record = VoucherCategory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherCategory::findOrFail($id);
        return $record->delete();
    }
}
