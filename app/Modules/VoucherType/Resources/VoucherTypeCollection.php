<?php

namespace App\Modules\VoucherType\Resources;

use App\Http\Resources\SuccessCollection;

class VoucherTypeCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            VoucherTypeResource::collection($resource),
            $message ?? 'VoucherType records fetched successfully'
        );
    }
}
