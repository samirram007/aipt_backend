<?php

namespace App\Modules\DiscountType\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DiscountTypeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code'=> $this->code,
            'isPercentage'=> $this->is_percentage,
            'value' => $this->value
        ];
    }
}
