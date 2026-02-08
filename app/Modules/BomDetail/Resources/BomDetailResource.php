<?php

namespace App\Modules\BomDetail\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;

class BomDetailResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
       return [
            'id' => $this->id,
            'bomId' => $this->bom_id,
            'stockItemId' => $this->stock_item_id,
            'qty' => $this->qty,
            'rate' => $this->rate,
            'amount' => $this->amount,

            'bom' => $this->whenLoaded('bom'),

            'stockItem' => $this->whenLoaded('stockItem'),

            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];
    }
}
