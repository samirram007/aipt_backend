<?php

namespace App\Modules\VoucherEntryPurge\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherEntryPurge\Models\VoucherEntryPurge;

interface VoucherEntryPurgeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherEntryPurge;
    public function store(array $data): VoucherEntryPurge;
    public function update(array $data, int $id): VoucherEntryPurge;
    public function delete(int $id): bool;
}
