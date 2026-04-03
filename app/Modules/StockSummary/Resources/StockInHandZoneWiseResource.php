<?php

namespace App\Modules\StockSummary\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockInHandZoneWiseResource extends SuccessResource
{
    public function toArray(Request $request): array
    {


        return [
            'zoneId' => data_get($this->resource, 'zone_id'),
            'zoneName' => data_get($this->resource, 'zone_name'),
            'zoneCode' => data_get($this->resource, 'zone_code'),
            'openingQuantity' => $this['opening_quantity'] ?? 0,
            'openingAmount' => $this['opening_amount'] ?? 0,
            'inwardQuantity' => $this['inward_quantity'] ?? 0,
            'inwardAmount' => $this['inward_amount'] ?? 0,
            'outwardQuantity' => $this['outward_quantity'] ?? 0,
            'outwardAmount' => $this['outward_amount'] ?? 0,
            'closingQuantity' => $this['closing_quantity'] ?? 0,
            'closingAmount' => $this['closing_amount'] ?? 0,
            'godownDetails' => StockInHandGodownWiseResource::collection(data_get($this->resource, 'godowns', [])),


        ];
    }
}
//In frontEnd (TypeScript)
// export const stockInHand = z.object({
//   itemId: z.number().int().positive(),
//   itemName: z.string().min(1),
//   unitCode: z.string().min(1),
//   unitName: z.string().min(1),
//   openingQuantity: z.coerce.number().nullish(),
//   openingAmount: z.coerce.number().nullish(),
//   inwardQuantity: z.coerce.number().nullish(),
//   inwardAmount: z.coerce.number().nullish(),
//   outwardQuantity: z.coerce.number().nullish(),
//   outwardAmount: z.coerce.number().nullish(),
//   closingQuantity: z.coerce.number().nullish(),
//   closingAmount: z.coerce.number().nullish(),
// })
