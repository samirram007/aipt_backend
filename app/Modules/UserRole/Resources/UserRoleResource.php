<?php

namespace App\Modules\UserRole\Resources;

use App\Modules\Role\Resources\RoleResource;
use App\Modules\User\Resources\UserResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class UserRoleResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'roleId' => $this->role_id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'role' => RoleResource::make($this->whenLoaded('role')),
        ];
    }
}
