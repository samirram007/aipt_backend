<?php

namespace App\Modules\DeliveryRoute\Resources;

use App\Modules\DeliveryPlace\Resources\DeliveryPlaceResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DeliveryRouteResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sourcePlaceId' => $this->source_place_id,
            'destinationPlaceId' => $this->destination_place_id,
            'distanceKm' => $this->distance_km,
            'estimatedTimeInMinutes' => $this->estimated_time_in_minutes,
            'rate' => $this->rate,
            'sourcePlace' => new DeliveryPlaceResource($this->whenLoaded('source_place')),
            'destinationPlace' => new DeliveryPlaceResource($this->whenLoaded('destination_place')),
        ];
    }
}
