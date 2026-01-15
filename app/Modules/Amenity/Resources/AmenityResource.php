<?php

namespace App\Modules\Amenity\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\AmenityCategory\Resources\AmenityCategoryResource;

class AmenityResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'amenityCategoryId' => $this->amenity_category_id,
            'amenityCategory' => AmenityCategoryResource::make($this->whenLoaded('amenity_categories')),
        ];
    }
}
