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
            'line1' => $this->line1,
            'line2' => $this->line2,
            'landmark' => $this->landmark,
            'city' => $this->city,
            'stateId' => $this->state_id,
            'state' => $this->whenLoaded('state', fn() => [
                'id' => $this->state->id,
                'name' => $this->state->name,
                'code' => $this->state->code,
                'gst_code' => $this->state->gst_code,
            ]),
            'countryId' => $this->country_id,
            'country' => $this->whenLoaded('country', fn() => [
                'id' => $this->country->id,
                'name' => $this->country->name,
                'iso_code' => $this->country->iso_code,
            ]),
            'postalCode' => $this->postal_code,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'addressType' => $this->address_type,
            'isPrimary' => $this->is_primary,
            'addressable' => [
                'id' => $this->addressable_id,
                'type' => class_basename($this->addressable_type),
            ],
        ];
    }
}
