<?php

namespace App\Modules\StockGroup\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockGroupResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
            'shouldQuantitiesOfItemsBeAdded' => $this->should_quantities_of_items_be_added,
            'parentId' => $this->parent_id,
            'parent' => new StockGroupResource($this->whenLoaded('parent')),


        ];
    }
}
