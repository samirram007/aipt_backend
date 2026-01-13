<?php

namespace App\Modules\PatientMedicalHistory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientMedicalHistory\Models\PatientMedicalHistory;

interface PatientMedicalHistoryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientMedicalHistory;
    public function store(array $data): PatientMedicalHistory;
    public function update(array $data, int $id): PatientMedicalHistory;
    public function delete(int $id): bool;
}
