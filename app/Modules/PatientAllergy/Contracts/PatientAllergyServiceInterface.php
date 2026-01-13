<?php

namespace App\Modules\PatientAllergy\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientAllergy\Models\PatientAllergy;

interface PatientAllergyServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientAllergy;
    public function store(array $data): PatientAllergy;
    public function update(array $data, int $id): PatientAllergy;
    public function delete(int $id): bool;
}
