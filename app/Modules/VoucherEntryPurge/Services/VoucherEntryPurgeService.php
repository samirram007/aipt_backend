<?php

namespace App\Modules\VoucherEntryPurge\Services;

use App\Modules\VoucherEntryPurge\Contracts\VoucherEntryPurgeServiceInterface;
use App\Modules\VoucherEntryPurge\Models\VoucherEntryPurge;
use Illuminate\Database\Eloquent\Collection;

class VoucherEntryPurgeService implements VoucherEntryPurgeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return VoucherEntryPurge::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherEntryPurge
    {
        return VoucherEntryPurge::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherEntryPurge
    {
        return VoucherEntryPurge::create($data);
    }

    public function update(array $data, int $id): VoucherEntryPurge
    {
        $record = VoucherEntryPurge::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherEntryPurge::findOrFail($id);
        return $record->delete();
    }
}
