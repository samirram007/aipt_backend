<?php

namespace App\Modules\PaymentVoucher\Services;

use App\Modules\PaymentVoucher\Contracts\PaymentVoucherServiceInterface;
use App\Modules\PaymentVoucher\Models\PaymentVoucher;
use Illuminate\Database\Eloquent\Collection;

class PaymentVoucherService implements PaymentVoucherServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PaymentVoucher::with($this->resource)->get();
    }

    public function getById(int $id): ?PaymentVoucher
    {
        return PaymentVoucher::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PaymentVoucher
    {
        return PaymentVoucher::create($data);
    }

    public function update(array $data, int $id): PaymentVoucher
    {
        $record = PaymentVoucher::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PaymentVoucher::findOrFail($id);
        return $record->delete();
    }
}
