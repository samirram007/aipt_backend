<?php

namespace App\Modules\Setting\Resources;

use App\Http\Resources\SuccessCollection;

class SettingCollection extends SuccessCollection
{
    public function __construct($resource, string $message = null)
    {
        parent::__construct(
            SettingResource::collection($resource),
            $message ?? 'Setting records fetched successfully'
        );
    }
}
