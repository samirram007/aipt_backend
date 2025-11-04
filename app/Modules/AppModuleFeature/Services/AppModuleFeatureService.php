<?php

namespace App\Modules\AppModuleFeature\Services;

use App\Modules\AppModuleFeature\Contracts\AppModuleFeatureServiceInterface;
use App\Modules\AppModuleFeature\Models\AppModuleFeature;
use Illuminate\Database\Eloquent\Collection;

class AppModuleFeatureService implements AppModuleFeatureServiceInterface
{
    protected $resource = ['module'];

    public function getAll(): Collection
    {
        return AppModuleFeature::with($this->resource)->get();
    }

    public function getById(int $id): ?AppModuleFeature
    {
        return AppModuleFeature::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AppModuleFeature
    {
        return AppModuleFeature::create($data);
    }

    public function update(array $data, int $id): AppModuleFeature
    {
        $record = AppModuleFeature::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AppModuleFeature::findOrFail($id);
        return $record->delete();
    }

    public function getByRoleAndModule(int $role_id, int $module_id): Collection
    {

        $data = AppModuleFeature::where('app_module_id', $module_id)
            ->with([
                'module',
                'role_permissions' => function ($query) use ($role_id) {
                    $query->where('role_id', $role_id);
                }
            ])
            ->get();
        // dd($data->toArray());
        return $data;
        // return AppModuleFeature::where('app_module_id', $module_id)->get();
    }
}
