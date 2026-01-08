<?php

namespace App\Modules\PatientTreatmentDetail\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientTreatmentDetail\Models\PatientTreatmentDetail;

interface PatientTreatmentDetailServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientTreatmentDetail;
    public function store(array $data): PatientTreatmentDetail;
    public function update(array $data, int $id): PatientTreatmentDetail;
    public function delete(int $id): bool;
}
