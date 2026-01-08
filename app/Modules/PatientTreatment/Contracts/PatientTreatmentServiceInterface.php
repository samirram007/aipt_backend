<?php

namespace App\Modules\PatientTreatment\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientTreatment\Models\PatientTreatment;

interface PatientTreatmentServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientTreatment;
    public function store(array $data): PatientTreatment;
    public function update(array $data, int $id): PatientTreatment;
    public function delete(int $id): bool;
}
