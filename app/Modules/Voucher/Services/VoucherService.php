<?php

namespace App\Modules\Voucher\Services;

use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;

class VoucherService implements VoucherServiceInterface
{
    public function getAll(): Collection
    {
        return Voucher::all();
    }

    public function getById(int $id): Voucher
    {
        return Voucher::findOrFail($id);
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
