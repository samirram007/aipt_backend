<?php

namespace App\Modules\VoucherClassification\Services;

use App\Modules\VoucherClassification\Contracts\VoucherClassificationServiceInterface;
use App\Modules\VoucherClassification\Models\VoucherClassification;
use Illuminate\Database\Eloquent\Collection;

class VoucherClassificationService implements VoucherClassificationServiceInterface
{
    protected $resource = ['voucher_type'];

    public function getAll(): Collection
    {
        return VoucherClassification::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherClassification
    {
        return VoucherClassification::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherClassification
    {
        return VoucherClassification::create($data);
    }

    public function update(array $data, int $id): VoucherClassification
    {
        $record = VoucherClassification::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherClassification::findOrFail($id);
        return $record->delete();
    }
}
