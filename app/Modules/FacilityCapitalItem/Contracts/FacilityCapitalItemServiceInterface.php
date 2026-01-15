<?php

namespace App\Modules\FacilityCapitalItem\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\FacilityCapitalItem\Models\FacilityCapitalItem;

interface FacilityCapitalItemServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?FacilityCapitalItem;
    public function store(array $data): FacilityCapitalItem;
    public function update(array $data, int $id): FacilityCapitalItem;
    public function delete(int $id): bool;
}
