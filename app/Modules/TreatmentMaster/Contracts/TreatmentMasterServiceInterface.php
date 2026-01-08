<?php

namespace App\Modules\TreatmentMaster\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TreatmentMaster\Models\TreatmentMaster;

interface TreatmentMasterServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?TreatmentMaster;
    public function store(array $data): TreatmentMaster;
    public function update(array $data, int $id): TreatmentMaster;
    public function delete(int $id): bool;
}
