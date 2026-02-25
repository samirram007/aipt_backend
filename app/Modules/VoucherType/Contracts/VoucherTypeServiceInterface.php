<?php

namespace App\Modules\VoucherType\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherType\Models\VoucherType;

interface VoucherTypeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): VoucherType;
    public function store(array $data): VoucherType;
    public function update(array $data, int $id): VoucherType;
    public function delete(int $id): bool;
}
