<?php

namespace App\Modules\AppModuleFeature\Resources;

use App\Modules\AppModule\Resources\AppModuleResource;
use App\Modules\RolePermission\Resources\RolePermissionResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class AppModuleFeatureResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
            'action' => $this->action,
            'appModuleId' => $this->app_module_id,
            'appModule' => AppModuleResource::make($this->whenLoaded('module')),
            'rolePermission' => $this->when(
                $this->relationLoaded('role_permissions'),
                fn() => RolePermissionResource::make($this->role_permissions->first())
            ),
            'rolePermissions' => RolePermissionResource::collection($this->whenLoaded('role_permissions'))
        ];
    }
}
