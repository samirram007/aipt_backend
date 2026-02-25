<?php

namespace App\Modules\OrderBook\Resources;

use App\Modules\Voucher\Resources\VoucherResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class OrderBookResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
       return (new VoucherResource($this->resource))->toArray($request);
    }
}
