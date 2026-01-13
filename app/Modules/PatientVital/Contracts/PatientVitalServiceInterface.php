<?php

namespace App\Modules\PatientVital\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientVital\Models\PatientVital;

interface PatientVitalServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientVital;
    public function store(array $data): PatientVital;
    public function update(array $data, int $id): PatientVital;
    public function delete(int $id): bool;
}
