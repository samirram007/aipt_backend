<?php

namespace App\Modules\AppModule\Resources;

use App\Modules\AppModuleFeature\Models\AppModuleFeature;
use App\Modules\AppModuleFeature\Resources\AppModuleFeatureResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class AppModuleResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
            'features' => AppModuleFeatureResource::collection($this->whenLoaded('app_module_features')),
        ];
    }
}
