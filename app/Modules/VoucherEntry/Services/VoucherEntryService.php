<?php

namespace App\Modules\VoucherEntry\Services;

use App\Modules\VoucherEntry\Contracts\VoucherEntryServiceInterface;
use App\Modules\VoucherEntry\Models\VoucherEntry;
use Illuminate\Database\Eloquent\Collection;

class VoucherEntryService implements VoucherEntryServiceInterface
{
    protected $resource = ['account_ledger'];

    public function getAll(): Collection
    {
        return VoucherEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherEntry
    {
        return VoucherEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherEntry
    {
        return VoucherEntry::create($data);
    }

    public function update(array $data, int $id): VoucherEntry
    {
        $record = VoucherEntry::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherEntry::findOrFail($id);
        return $record->delete();
    }
}
