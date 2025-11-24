<?php

namespace App\Modules\VoucherReference\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Voucher\Resources\VoucherResource;

class VoucherReferenceResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherId' => $this->voucher_id,
            'voucherReferenceId' => $this->voucher_reference_id,
            'voucher' => VoucherResource::make($this->whenLoaded('voucher')),
            'voucherReference' => VoucherResource::make($this->whenLoaded('voucher_reference'))
        ];
    }
}
