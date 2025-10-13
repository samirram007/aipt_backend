<?php

namespace App\Modules\Doctor\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Doctor\Models\Doctor;

interface DoctorServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?Doctor;
    public function store(array $data): Doctor;
    public function update(array $data, int $id): Doctor;
    public function delete(int $id): bool;
}
