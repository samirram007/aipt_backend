<?php

namespace App\Modules\VoucherPaymentMode\Services;

use App\Modules\VoucherPaymentMode\Contracts\VoucherPaymentModeServiceInterface;
use App\Modules\VoucherPaymentMode\Models\VoucherPaymentMode;
use Illuminate\Database\Eloquent\Collection;

class VoucherPaymentModeService implements VoucherPaymentModeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return VoucherPaymentMode::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherPaymentMode
    {
        return VoucherPaymentMode::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherPaymentMode
    {
        return VoucherPaymentMode::create($data);
    }

    public function update(array $data, int $id): VoucherPaymentMode
    {
        $record = VoucherPaymentMode::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherPaymentMode::findOrFail($id);
        return $record->delete();
    }
}
