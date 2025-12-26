<?php

namespace App\Modules\Vehicle\Resources;

use App\Modules\Transporter\Resources\TransporterResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VehicleResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'transporterId' => $this->transporter_id,
            'vehicleType' => $this->vehicle_type,
            'vehicleNumber' => $this->vehicle_no,
            'description' => $this->description,
            'status' => $this->status,
            'transporter' => new TransporterResource($this->whenLoaded('transporter')),
        ];
    }
}
