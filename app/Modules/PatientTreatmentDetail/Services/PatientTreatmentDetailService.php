<?php

namespace App\Modules\PatientTreatmentDetail\Services;

use App\Modules\PatientTreatmentDetail\Contracts\PatientTreatmentDetailServiceInterface;
use App\Modules\PatientTreatmentDetail\Models\PatientTreatmentDetail;
use Illuminate\Database\Eloquent\Collection;

class PatientTreatmentDetailService implements PatientTreatmentDetailServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PatientTreatmentDetail::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientTreatmentDetail
    {
        return PatientTreatmentDetail::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientTreatmentDetail
    {
        return PatientTreatmentDetail::create($data);
    }

    public function update(array $data, int $id): PatientTreatmentDetail
    {
        $record = PatientTreatmentDetail::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientTreatmentDetail::findOrFail($id);
        return $record->delete();
    }
}
