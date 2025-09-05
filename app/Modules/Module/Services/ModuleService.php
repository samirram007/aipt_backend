<?php

namespace App\Modules\Module\Services;

use App\Modules\Module\Contracts\ModuleServiceInterface;
use App\Modules\Module\Models\Module;
use Illuminate\Database\Eloquent\Collection;

class ModuleService implements ModuleServiceInterface
{
    public function getAll(): Collection
    {
        return Module::all();
    }

    public function getById(int $id): Module
    {
        return Module::findOrFail($id);
    }

    public function store(array $data): Module
    {
        return Module::create($data);
    }

    public function update(array $data, int $id): Module
    {
        $record = Module::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Module::findOrFail($id);
        return $record->delete();
    }
}
