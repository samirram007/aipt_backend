<?php

namespace App\Modules\PatientTreatment\Services;

use App\Modules\PatientTreatment\Contracts\PatientTreatmentServiceInterface;
use App\Modules\PatientTreatment\Models\PatientTreatment;
use Illuminate\Database\Eloquent\Collection;

class PatientTreatmentService implements PatientTreatmentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PatientTreatment::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientTreatment
    {
        return PatientTreatment::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientTreatment
    {
        return PatientTreatment::create($data);
    }

    public function update(array $data, int $id): PatientTreatment
    {
        $record = PatientTreatment::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientTreatment::findOrFail($id);
        return $record->delete();
    }
}
