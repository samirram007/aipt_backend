<?php

namespace App\Modules\Bom\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\StockItem\Resources\StockItemResource;
use App\Modules\BomDetail\Resources\BomDetailResource;
class BomResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'stockItemId' => $this->stock_item_id,
            'status' => $this->status,

            'stockItem' => new StockItemResource(
                $this->whenLoaded('stockItem')
            ),
            'bomDetails' => BomDetailResource::collection(
                $this->whenLoaded('details')
            ),


            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];
    }
}
