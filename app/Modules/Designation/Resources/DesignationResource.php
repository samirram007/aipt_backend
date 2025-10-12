<?php

namespace App\Modules\Designation\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DesignationResource extends SuccessResource
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
