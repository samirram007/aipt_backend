<?php

namespace App\Modules\Post\Resources;

use App\Http\Resources\SuccessCollection;

class PostCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            PostResource::collection($resource),
            $message ?? 'Post records fetched successfully'
        );
    }
}
