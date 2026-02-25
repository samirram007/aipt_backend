<?php

namespace App\Modules\Country\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\State\Resources\StateCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phoneCode' => $this->phone_code,
            'isoCode' => $this->iso_code,
            // 'states' => new StateCollection($this->whenLoaded('states')),

        ];
    }
}
