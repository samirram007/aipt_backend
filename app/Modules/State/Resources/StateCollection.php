<?php

namespace App\Modules\State\Resources;

use App\Http\Resources\SuccessCollection;

class StateCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            StateResource::collection($resource),
            $message ?? 'State records fetched successfully'
        );
    }
}
