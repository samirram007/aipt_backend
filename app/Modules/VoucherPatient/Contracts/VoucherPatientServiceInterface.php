<?php

namespace App\Modules\VoucherPatient\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherPatient\Models\VoucherPatient;

interface VoucherPatientServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherPatient;
    public function store(array $data): VoucherPatient;
    public function update(array $data, int $id): VoucherPatient;
    public function delete(int $id): bool;
}
