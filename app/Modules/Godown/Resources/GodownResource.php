<?php

namespace App\Modules\Godown\Resources;

use App\Modules\Address\Resources\AddressResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class GodownResource extends SuccessResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,

            'description' => $this->description,
            'status' => $this->status,

            'ourStockWithThirdParty' => $this->our_stock_with_third_party,
            'thirdPartyStockWithUs' => $this->third_party_stock_with_us,
            'parentId' => $this->parent_id,
            'parent' => GodownResource::make($this->whenLoaded('parent')),
            'address' => AddressResource::make($this->whenLoaded('address')),


        ];
    }
}
