<?php

namespace App\Modules\AppMaintenance\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\AppMaintenance\Models\AppMaintenance;

interface AppMaintenanceServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?AppMaintenance;
    public function store(array $data): AppMaintenance;
    public function update(array $data, int $id): AppMaintenance;
    public function delete(int $id): bool;
}
