<?php

namespace App\Modules\Voucher\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Voucher\Models\Voucher;

interface VoucherServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Voucher;
    public function store(array $data): Voucher;
    public function update(array $data, int $id): Voucher;
    public function delete(int $id): bool;
}
