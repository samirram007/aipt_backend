<?php

namespace App\Modules\AmenityCategory\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Amenity\Resources\AmenityResource;

class AmenityCategoryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'amenities' => AmenityResource::collection($this->whenLoaded('amenities')),
            'status' => $this->status,
        ];
    }
}
