<?php

namespace App\Modules\VoucherDispatchDetail\Services;

use App\Modules\VoucherDispatchDetail\Contracts\VoucherDispatchDetailServiceInterface;
use App\Modules\VoucherDispatchDetail\Models\VoucherDispatchDetail;
use Illuminate\Database\Eloquent\Collection;

class VoucherDispatchDetailService implements VoucherDispatchDetailServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return VoucherDispatchDetail::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherDispatchDetail
    {
        return VoucherDispatchDetail::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherDispatchDetail
    {
        return VoucherDispatchDetail::create($data);
    }

    public function update(array $data, int $id): VoucherDispatchDetail
    {
        $record = VoucherDispatchDetail::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherDispatchDetail::findOrFail($id);
        return $record->delete();
    }
}
