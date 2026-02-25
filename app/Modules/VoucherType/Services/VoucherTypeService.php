<?php

namespace App\Modules\VoucherType\Services;

use App\Modules\VoucherType\Contracts\VoucherTypeServiceInterface;
use App\Modules\VoucherType\Models\VoucherType;
use Illuminate\Database\Eloquent\Collection;

class VoucherTypeService implements VoucherTypeServiceInterface
{
    protected $resource = ['voucher_category'];

    public function getAll(): Collection
    {
        return VoucherType::with($this->resource)->get();
    }

    public function getById(int $id): VoucherType
    {
        return VoucherType::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherType
    {
        return VoucherType::create($data);
    }

    public function update(array $data, int $id): VoucherType
    {
        $record = VoucherType::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherType::findOrFail($id);
        return $record->delete();
    }
}
