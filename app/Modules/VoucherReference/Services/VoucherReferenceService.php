<?php

namespace App\Modules\VoucherReference\Services;

use App\Modules\VoucherReference\Contracts\VoucherReferenceServiceInterface;
use App\Modules\VoucherReference\Models\VoucherReference;
use Illuminate\Database\Eloquent\Collection;

class VoucherReferenceService implements VoucherReferenceServiceInterface
{
    protected $resource = ['voucher', 'reference_voucher'];

    public function getAll(): Collection
    {
        return VoucherReference::with($this->resource)->get();
    }
    public function getByVoucherId(int $voucherId): Collection
    {
        return VoucherReference::with($this->resource)
            ->where('voucher_id', $voucherId)
            ->get();
    }
    public function getByReferenceVoucherId(int $voucherId): Collection
    {
        return VoucherReference::with($this->resource)
            ->where('ref_voucher_id', $voucherId)
            ->get();
    }

    public function getByVoucherIdAndReferenceVoucherId(int $voucherId, int $refVoucherId): ?VoucherReference
    {
        return VoucherReference::with($this->resource)
            ->where('voucher_id', $voucherId)
            ->where('ref_voucher_id', $refVoucherId)
            ->first();
    }

    public function getByVoucherIdOrReferenceVoucherId(int $voucherId, int $refVoucherId): ?Collection
    {
        return VoucherReference::with($this->resource)
            ->where('voucher_id', $voucherId)
            ->OrWhere('ref_voucher_id', $refVoucherId)
            ->get();
    }


    public function getById(int $id): ?VoucherReference
    {
        return VoucherReference::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherReference
    {
        return VoucherReference::create($data);
    }

    public function update(array $data, int $id): VoucherReference
    {
        $record = VoucherReference::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherReference::findOrFail($id);
        return $record->delete();
    }
}
