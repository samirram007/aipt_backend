<?php

namespace App\Modules\Voucher\Services;

use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;

class VoucherService implements VoucherServiceInterface
{
    protected $resource = ['voucher_entries.account_ledger',
    'stock_journal.stock_journal_entries.stock_item',
    'stock_journal.stock_journal_entries.stock_unit','voucher_references.voucher'];

    public function getAll(): Collection
    {
        return Voucher::with($this->resource)->get();
    }

    public function getById(int $id): ?Voucher
    {
        return Voucher::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Voucher
    {
        return Voucher::create($data);
    }

    public function update(array $data, int $id): Voucher
    {
        $record = Voucher::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Voucher::findOrFail($id);
        return $record->delete();
    }
}
