<?php

namespace App\Modules\StockSummary\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockInHandItemWiseResource extends SuccessResource
{
    public function toArray(Request $request): array
    {


        return [
            'itemId' => $this['item_id'],
            'itemName' => $this['item_name'],
            'unitCode' => $this['unit_code'] ?? null,
            'unitName' => $this['unit_name'] ?? null,
            'noOfDecimalPlaces' => $this['no_of_decimal_places'] ?? 3,
            'openingQuantity' => $this['opening_quantity'] ?? 0,
            'openingAmount' => $this['opening_amount'] ?? 0,
            'inwardQuantity' => $this['inward_quantity'] ?? 0,
            'inwardAmount' => $this['inward_amount'] ?? 0,
            'outwardQuantity' => $this['outward_quantity'] ?? 0,
            'outwardAmount' => $this['outward_amount'] ?? 0,
            'closingQuantity' => $this['closing_quantity'] ?? 0,
            'closingAmount' => $this['closing_amount'] ?? 0,
            'godownDetails' => StockInHandGodownWiseResource::collection($this['godown_details'] ?? []),


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
