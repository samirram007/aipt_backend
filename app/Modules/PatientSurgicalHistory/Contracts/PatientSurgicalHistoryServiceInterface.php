<?php

namespace App\Modules\PatientSurgicalHistory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientSurgicalHistory\Models\PatientSurgicalHistory;

interface PatientSurgicalHistoryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientSurgicalHistory;
    public function store(array $data): PatientSurgicalHistory;
    public function update(array $data, int $id): PatientSurgicalHistory;
    public function delete(int $id): bool;
}
