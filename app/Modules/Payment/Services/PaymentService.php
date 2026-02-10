<?php

namespace App\Modules\Payment\Services;

use App\Modules\Payment\Contracts\PaymentServiceInterface;
use App\Modules\Payment\Models\Payment;
use App\Modules\VoucherReference\Models\VoucherReference;
use Illuminate\Database\Eloquent\Collection;

class PaymentService implements PaymentServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return Payment::with($this->resource)->get();
    }

    public function getById(int $id): ?Payment
    {
        return Payment::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Payment
    {
        return Payment::create($data);
    }

    public function update(array $data, int $id): Payment
    {
        $record = Payment::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Payment::findOrFail($id);
        return $record->delete();
    }

    public function getPaymentsByFreightId(int $freight_id): Collection
    {
        $freightPaymentReferences = VoucherReference::where('reference_id', $freight_id)
            ->where('type', 'freight_payment')
            ->get();

        return Payment::with($this->resource)->where('freight_id', $freight_id)->get();
    }
}
