<?php

namespace App\Modules\PaymentTransaction\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PaymentTransaction\Models\PaymentTransaction;

interface PaymentTransactionServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PaymentTransaction;
    public function store(array $data): PaymentTransaction;
    public function update(array $data, int $id): PaymentTransaction;
    public function delete(int $id): bool;
}
