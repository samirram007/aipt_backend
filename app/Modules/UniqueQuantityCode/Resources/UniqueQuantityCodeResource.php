<?php

namespace App\Modules\UniqueQuantityCode\Resources;

use App\Enums\QuantityType;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class UniqueQuantityCodeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'status' => $this->status,
            'icon' => $this->icon,
            'quantityType' => $this->quantity_type?->value,

        ];
    }
}
