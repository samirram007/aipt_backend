<?php

namespace App\Modules\ReceiptVoucher\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class ReceiptVoucherCollection extends SuccessCollection
{

         /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
