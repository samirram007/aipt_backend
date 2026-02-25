<?php

namespace App\Modules\DeliveryPlace\Resources;

use App\Modules\Address\Resources\AddressResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DeliveryPlaceResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'placeType' => $this->place_type,
            'isActive' => $this->is_active,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'address' => new AddressResource($this->whenLoaded('address')),

        ];
    }
}
