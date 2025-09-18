<?php

namespace App\Modules\StockUnit\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockUnitResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'status' => $this->status,
            'unitType' => $this->unit_type,
            'quantityType' => $this->quantity_type,
            'icon' => $this->icon,
            'uniqueQuantityCodeId' => $this->uqc_id,
            'primaryStockUnitId' => $this->primary_stock_unit_id, // assuming 'Pieces' is id 11
            'primaryStockUnit' => new StockUnitResource($this->whenLoaded('primary_stock_unit')),
            'secondaryStockUnitId' => $this->secondary_stock_unit_id,
            'secondaryStockUnit' => new StockUnitResource($this->whenLoaded('secondary_stock_unit')),
            'conversionFactor' => $this->conversion_factor,
            'noOfDecimalPlaces' => $this->no_of_decimal_places
        ];
    }
}
