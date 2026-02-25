<?php

namespace App\Modules\GstRegistrationType\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class GstRegistrationTypeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
        ];
    }
}
