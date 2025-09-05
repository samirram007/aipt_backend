<?php

namespace App\Modules\Voucher\Resources;

use App\Http\Resources\SuccessCollection;

class VoucherCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            VoucherResource::collection($resource),
            $message ?? 'Voucher records fetched successfully'
        );
    }
}
