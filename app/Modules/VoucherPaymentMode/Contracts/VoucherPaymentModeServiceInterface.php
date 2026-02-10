<?php

namespace App\Modules\VoucherPaymentMode\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherPaymentMode\Models\VoucherPaymentMode;

interface VoucherPaymentModeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherPaymentMode;
    public function store(array $data): VoucherPaymentMode;
    public function update(array $data, int $id): VoucherPaymentMode;
    public function delete(int $id): bool;
}
