<?php

namespace App\Modules\Module\Resources;

use App\Http\Resources\SuccessCollection;

class ModuleCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            ModuleResource::collection($resource),
            $message ?? 'Module records fetched successfully'
        );
    }
}
