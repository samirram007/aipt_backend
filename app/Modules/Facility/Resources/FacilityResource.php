<?php

namespace App\Modules\Facility\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Amenity\Resources\AmenityCollection;
use App\Modules\Amenity\Resources\AmenityResource;
use App\Modules\Building\Resources\BuildingResource;

class FacilityResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'parentId' => $this->parent_id,
            'facilityableId' => $this->facilityable_id,
            'facilityableType' => $this->facilityable_type,
            'details' => $this->whenLoaded('facilityable', fn() => $this->facilityable->facility_description ?? null),
            'amenities' => AmenityResource::collection($this->whenLoaded('amenities')),
            'childrens' => FacilityResource::collection($this->whenLoaded('children')),
        ];
    }
}
