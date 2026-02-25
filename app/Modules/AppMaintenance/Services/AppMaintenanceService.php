<?php

namespace App\Modules\AppMaintenance\Services;

use App\Modules\AppMaintenance\Contracts\AppMaintenanceServiceInterface;
use App\Modules\AppMaintenance\Models\AppMaintenance;
use Illuminate\Database\Eloquent\Collection;

class AppMaintenanceService implements AppMaintenanceServiceInterface
{
    public function getAll(): Collection
    {
        return AppMaintenance::all();
    }

    public function getById(int $id): ?AppMaintenance
    {
        return AppMaintenance::findOrFail($id);
    }

    public function store(array $data): AppMaintenance
    {
        return AppMaintenance::create($data);
    }

    public function update(array $data, int $id): AppMaintenance
    {
        $record = AppMaintenance::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AppMaintenance::findOrFail($id);
        return $record->delete();
    }
}
