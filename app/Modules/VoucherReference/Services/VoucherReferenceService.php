<?php

namespace App\Modules\VoucherReference\Services;

use App\Modules\VoucherReference\Contracts\VoucherReferenceServiceInterface;
use App\Modules\VoucherReference\Models\VoucherReference;
use Illuminate\Database\Eloquent\Collection;

class VoucherReferenceService implements VoucherReferenceServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return VoucherReference::with($this->resource)->get();
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
