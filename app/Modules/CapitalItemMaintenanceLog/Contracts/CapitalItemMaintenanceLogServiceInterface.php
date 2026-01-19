<?php

namespace App\Modules\CapitalItemMaintenanceLog\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\CapitalItemMaintenanceLog\Models\CapitalItemMaintenanceLog;

interface CapitalItemMaintenanceLogServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?CapitalItemMaintenanceLog;
    public function store(array $data): CapitalItemMaintenanceLog;
    public function update(array $data, int $id): CapitalItemMaintenanceLog;
    public function delete(int $id): bool;
}
