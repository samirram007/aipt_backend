<?php

namespace App\Modules\PatientSurgicalHistory\Services;

use App\Modules\PatientSurgicalHistory\Contracts\PatientSurgicalHistoryServiceInterface;
use App\Modules\PatientSurgicalHistory\Models\PatientSurgicalHistory;
use Illuminate\Database\Eloquent\Collection;

class PatientSurgicalHistoryService implements PatientSurgicalHistoryServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PatientSurgicalHistory::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientSurgicalHistory
    {
        return PatientSurgicalHistory::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientSurgicalHistory
    {
        return PatientSurgicalHistory::create($data);
    }

    public function update(array $data, int $id): PatientSurgicalHistory
    {
        $record = PatientSurgicalHistory::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientSurgicalHistory::findOrFail($id);
        return $record->delete();
    }
}
