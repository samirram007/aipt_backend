<?php

namespace App\Modules\PatientMedicalHistory\Services;

use App\Modules\PatientMedicalHistory\Contracts\PatientMedicalHistoryServiceInterface;
use App\Modules\PatientMedicalHistory\Models\PatientMedicalHistory;
use Illuminate\Database\Eloquent\Collection;

class PatientMedicalHistoryService implements PatientMedicalHistoryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PatientMedicalHistory::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientMedicalHistory
    {
        return PatientMedicalHistory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientMedicalHistory
    {
        return PatientMedicalHistory::create($data);
    }

    public function update(array $data, int $id): PatientMedicalHistory
    {
        $record = PatientMedicalHistory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientMedicalHistory::findOrFail($id);
        return $record->delete();
    }
}
