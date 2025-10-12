<?php

namespace App\Modules\Department\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DepartmentResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,

        ];
    }
}
