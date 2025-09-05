<?php

namespace App\Modules\VoucherType\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\VoucherCategory\Resources\VoucherCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherTypeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'moduleLink' => $this->module_link,
            'status' => $this->status,
            'icon' => $this->icon,
            'voucherCategoryId' => $this->voucher_category_id,
            'voucherCategory' => new VoucherCategoryResource($this->whenLoaded('voucher_category')),

        ];
    }
}
