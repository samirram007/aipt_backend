<?php

namespace App\Modules\PaymentVoucher\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PaymentVoucher\Models\PaymentVoucher;

interface PaymentVoucherServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PaymentVoucher;
    public function store(array $data): PaymentVoucher;
    public function update(array $data, int $id): PaymentVoucher;
    public function delete(int $id): bool;
}
