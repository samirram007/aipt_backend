<?php

namespace App\Modules\StockCategory\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class StockCategoryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
            'parentId' => $this->parent_id,
            'parent' => new StockCategoryResource($this->whenLoaded('parent')),


        ];
    }
}
