<?php

namespace App\Modules\PaymentMode\Services;

use App\Modules\PaymentMode\Contracts\PaymentModeServiceInterface;
use App\Modules\PaymentMode\Models\PaymentMode;
use Illuminate\Database\Eloquent\Collection;

class PaymentModeService implements PaymentModeServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PaymentMode::with($this->resource)->get();
    }

    public function getById(int $id): ?PaymentMode
    {
        return PaymentMode::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PaymentMode
    {
        return PaymentMode::create($data);
    }

    public function update(array $data, int $id): PaymentMode
    {
        $record = PaymentMode::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PaymentMode::findOrFail($id);
        return $record->delete();
    }
}
