<?php

namespace App\Modules\VoucherDispatchDetail\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherDispatchDetail\Models\VoucherDispatchDetail;

interface VoucherDispatchDetailServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherDispatchDetail;
    public function store(array $data): VoucherDispatchDetail;
    public function update(array $data, int $id): VoucherDispatchDetail;
    public function delete(int $id): bool;
}
