<?php

namespace App\Modules\VoucherReference\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherReferenceResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucher_id' => $this->voucher_id,
            'ref_voucher_id' => $this->ref_voucher_id,
            'voucher' => $this->whenLoaded('voucher'),
            'reference_voucher' => $this->whenLoaded('reference_voucher'),
            'type' => $this->type,
        ];
    }
}
