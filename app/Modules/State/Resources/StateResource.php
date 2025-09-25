<?php

namespace App\Modules\State\Resources;

use App\Http\Resources\SuccessResource;

use App\Modules\Country\Resources\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends SuccessResource
{
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'gstCode' => $this->gst_code,
            'countryId' => $this->country_id,
            // 'country' => $this->whenLoaded('country'),
            'country' => CountryResource::make($this->whenLoaded('country')),


        ];
    }
}
