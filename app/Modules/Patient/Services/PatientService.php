<?php

namespace App\Modules\Patient\Services;

use App\Modules\Patient\Contracts\PatientServiceInterface;
use App\Modules\Patient\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

class PatientService implements PatientServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Patient::with($this->resource)->get();
    }

    public function getById(int $id): ?Patient
    {
        return Patient::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Patient
    {
        return Patient::create($data);
    }

    public function update(array $data, int $id): Patient
    {
        $record = Patient::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Patient::findOrFail($id);
        return $record->delete();
    }
}
