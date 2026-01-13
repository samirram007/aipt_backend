<?php

namespace App\Modules\PatientVital\Services;

use App\Modules\PatientVital\Contracts\PatientVitalServiceInterface;
use App\Modules\PatientVital\Models\PatientVital;
use Illuminate\Database\Eloquent\Collection;

class PatientVitalService implements PatientVitalServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PatientVital::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientVital
    {
        return PatientVital::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientVital
    {
        return PatientVital::create($data);
    }

    public function update(array $data, int $id): PatientVital
    {
        $record = PatientVital::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientVital::findOrFail($id);
        return $record->delete();
    }
}
