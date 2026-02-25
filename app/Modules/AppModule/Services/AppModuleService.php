<?php

namespace App\Modules\AppModule\Services;

use App\Modules\AppModule\Contracts\AppModuleServiceInterface;
use App\Modules\AppModule\Models\AppModule;
use Illuminate\Database\Eloquent\Collection;

class AppModuleService implements AppModuleServiceInterface
{
    protected $resource = ['app_module_features'];

    public function getAll(): Collection
    {
        return AppModule::with($this->resource)->get();
    }

    public function getById(int $id): ?AppModule
    {
        return AppModule::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AppModule
    {
        return AppModule::create($data);
    }

    public function update(array $data, int $id): AppModule
    {
        $record = AppModule::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AppModule::findOrFail($id);
        return $record->delete();
    }
}
