<?php

namespace App\Modules\VoucherReference\Resources;

use App\Modules\Voucher\Resources\VoucherResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherReferenceResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherId' => $this->voucher_id,
            'refVoucherId' => $this->ref_voucher_id,
            'voucher' => VoucherResource::make($this->whenLoaded('voucher')),
            'referenceVoucher' => VoucherResource::make($this->whenLoaded('reference_voucher')),
            'type' => $this->type,
        ];
    }
}
