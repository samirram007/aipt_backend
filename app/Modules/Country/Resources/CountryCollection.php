<?php

namespace App\Modules\Country\Resources;

use App\Http\Resources\SuccessCollection;

class CountryCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            CountryResource::collection($resource),
            $message ?? 'Country records fetched successfully'
        );
    }
}
