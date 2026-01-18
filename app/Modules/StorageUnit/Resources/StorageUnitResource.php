<?php

namespace App\Modules\StorageUnit\Resources;

use App\Modules\StockUnit\Resources\StockUnitResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StorageUnitResource extends SuccessResource
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
            'storageUnitType' => $this->storage_unit_type,
            'storageUnitCategory' => $this->storage_unit_category,
            'parentId' => $this->parent_id,
            'isVirtual' => $this->is_virtual,
            'isMobile' => $this->is_mobile,
            'capacityValue' => $this->capacity_value,
            'capacityUnitId' => $this->capacity_unit_id,
            'temperatureMin' => $this->temperature_min,
            'temperatureMax' => $this->temperature_max,
            'ourStockWithThirdParty' => $this->our_stock_with_third_party,
            'thirdPartyStockWithUs' => $this->third_party_stock_with_us,
            'parent' => StorageUnitResource::make($this->whenLoaded('parent')),
            'capacityUnit' => StockUnitResource::make($this->whenLoaded('capacity_unit')),
        ];
    }
}
