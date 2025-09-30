<?php

namespace App\Modules\VoucherEntry\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherEntry\Models\VoucherEntry;

interface VoucherEntryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherEntry;
    public function store(array $data): VoucherEntry;
    public function update(array $data, int $id): VoucherEntry;
    public function delete(int $id): bool;
}
