<?php

namespace App\Modules\VoucherDispatchDetail\Services;

use App\Modules\VoucherDispatchDetail\Contracts\VoucherDispatchDetailServiceInterface;
use App\Modules\VoucherDispatchDetail\Models\VoucherDispatchDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class VoucherDispatchDetailService implements VoucherDispatchDetailServiceInterface
{
    protected $resource = [];

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
        if ($data['voucher_id']) {
            //ensure only one dispatch detail per voucher
            Log::info("Checking existing dispatch detail for voucher ID {$data['voucher_id']}");
            $existing = VoucherDispatchDetail::where('voucher_id', $data['voucher_id'])->first();
            if ($existing) {
                $existing->update($data);
                return $existing->fresh();
                // throw new \Exception("Dispatch detail for voucher ID {$data['voucher_id']} already exists.");
            }
        }
        Log::info("Creating dispatch detail for voucher ID {$data['voucher_id']}");
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
