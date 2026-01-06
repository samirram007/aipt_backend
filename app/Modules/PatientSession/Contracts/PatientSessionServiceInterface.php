<?php

namespace App\Modules\PatientSession\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\PatientSession\Models\PatientSession;

interface PatientSessionServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?PatientSession;
    public function store(array $data): PatientSession;
    public function update(array $data, int $id): PatientSession;
    public function delete(int $id): bool;
}
