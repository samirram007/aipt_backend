<?php

namespace App\Modules\Language\Resources;

use App\Http\Resources\SuccessCollection;

class LanguageCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            LanguageResource::collection($resource),
            $message ?? 'Language records fetched successfully'
        );
    }
}
