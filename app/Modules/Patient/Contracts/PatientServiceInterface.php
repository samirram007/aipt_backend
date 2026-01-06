<?php

namespace App\Modules\Patient\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Patient\Models\Patient;

interface PatientServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Patient;
    public function store(array $data): Patient;
    public function update(array $data, int $id): Patient;
    public function delete(int $id): bool;
}
