<?php

namespace App\Modules\Building\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;

class BuildingResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'buildingType' => $this->building_type,
            'totalAreaSqft' => $this->total_area_sqft,
            'coveredAreaSqft' => $this->covered_area_sqft,
            'yearOfConstruction' => $this->year_of_construction,
            'sesmicZoneCompliance' => $this->sesmic_zone_compliance,
            'structuralType' => $this->structural_type,
        ];
    }
}
