<?php

namespace App\Modules\VoucherPatient\Services;

use App\Modules\VoucherPatient\Contracts\VoucherPatientServiceInterface;
use App\Modules\VoucherPatient\Models\VoucherPatient;
use Illuminate\Database\Eloquent\Collection;

class VoucherPatientService implements VoucherPatientServiceInterface
{
    protected $resource=['agent','physician','patient.account_ledger'];

    public function getAll(): Collection
    {
        return VoucherPatient::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherPatient
    {
        return VoucherPatient::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherPatient
    {
        return VoucherPatient::create($data);
    }

    public function update(array $data, int $id): VoucherPatient
    {
        $record = VoucherPatient::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherPatient::findOrFail($id);
        return $record->delete();
    }
}
