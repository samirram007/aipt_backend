<?php

namespace App\Modules\Currency\Resources;

use App\Http\Resources\SuccessCollection;

class CurrencyCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            CurrencyResource::collection($resource),
            $message ?? 'Currency records fetched successfully'
        );
    }
}
