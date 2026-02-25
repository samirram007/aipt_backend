<?php

namespace App\Modules\Journal\Resources;

use App\Http\Resources\SuccessCollection;

class JournalCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            JournalResource::collection($resource),
            $message ?? 'Journal records fetched successfully'
        );
    }
}
