<?php

namespace App\Modules\PatientAllergy\Services;

use App\Modules\PatientAllergy\Contracts\PatientAllergyServiceInterface;
use App\Modules\PatientAllergy\Models\PatientAllergy;
use Illuminate\Database\Eloquent\Collection;

class PatientAllergyService implements PatientAllergyServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return PatientAllergy::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientAllergy
    {
        return PatientAllergy::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientAllergy
    {
        return PatientAllergy::create($data);
    }

    public function update(array $data, int $id): PatientAllergy
    {
        $record = PatientAllergy::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientAllergy::findOrFail($id);
        return $record->delete();
    }
}
