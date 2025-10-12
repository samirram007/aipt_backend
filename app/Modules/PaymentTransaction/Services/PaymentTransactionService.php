<?php

namespace App\Modules\PaymentTransaction\Services;

use App\Modules\PaymentTransaction\Contracts\PaymentTransactionServiceInterface;
use App\Modules\PaymentTransaction\Models\PaymentTransaction;
use Illuminate\Database\Eloquent\Collection;

class PaymentTransactionService implements PaymentTransactionServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PaymentTransaction::with($this->resource)->get();
    }

    public function getById(int $id): ?PaymentTransaction
    {
        return PaymentTransaction::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PaymentTransaction
    {
        return PaymentTransaction::create($data);
    }

    public function update(array $data, int $id): PaymentTransaction
    {
        $record = PaymentTransaction::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PaymentTransaction::findOrFail($id);
        return $record->delete();
    }
}
