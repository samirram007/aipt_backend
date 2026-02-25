<?php

namespace App\Modules\User\Resources;

use App\Http\Resources\SuccessCollection;

class UserCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            UserResource::collection($resource),
            $message ?? 'User records fetched successfully'
        );
    }
}
