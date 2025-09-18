<?php

namespace App\Modules\Address\Resources;

use App\Enums\AddressType;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class AddressResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'line1' => $this->address_line1,
            'line2' => $this->address_line2,
            'landmark' => $this->landmark,
            'city' => $this->city,
            'state' => $this->whenLoaded('state', fn() => [
                'id' => $this->state->id,
                'name' => $this->state->name,
                'code' => $this->state->code,
                'gst_code' => $this->state->gst_code,
            ]),
            'country' => $this->whenLoaded('country', fn() => [
                'id' => $this->country->id,
                'name' => $this->country->name,
                'iso_code' => $this->country->iso_code,
            ]),
            'postal_code' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address_type' => AddressType::from($this->address_type)->value,
            'is_primary' => (bool) $this->is_primary,
            'addressable' => [
                'id' => $this->addressable_id,
                'type' => class_basename($this->addressable_type),
            ],
        ];
    }
}
