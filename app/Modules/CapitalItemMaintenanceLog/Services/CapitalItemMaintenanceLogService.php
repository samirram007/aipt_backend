<?php

namespace App\Modules\CapitalItemMaintenanceLog\Services;

use App\Modules\CapitalItemMaintenanceLog\Contracts\CapitalItemMaintenanceLogServiceInterface;
use App\Modules\CapitalItemMaintenanceLog\Models\CapitalItemMaintenanceLog;
use Illuminate\Database\Eloquent\Collection;

class CapitalItemMaintenanceLogService implements CapitalItemMaintenanceLogServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return CapitalItemMaintenanceLog::with($this->resource)->get();
    }

    public function getById(int $id): ?CapitalItemMaintenanceLog
    {
        return CapitalItemMaintenanceLog::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): CapitalItemMaintenanceLog
    {
        return CapitalItemMaintenanceLog::create($data);
    }

    public function update(array $data, int $id): CapitalItemMaintenanceLog
    {
        $record = CapitalItemMaintenanceLog::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = CapitalItemMaintenanceLog::findOrFail($id);
        return $record->delete();
    }
}
