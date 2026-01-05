<?php

namespace App\Modules\DeliveryVehicle\Resources;

use App\Modules\Transporter\Resources\TransporterResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DeliveryVehicleResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'transporterId' => $this->transporter_id,
            'vehicleNumber' => $this->vehicle_number,
            'vehicleType' => $this->vehicle_type,
            'capacity' => $this->capacity,
            'driverName' => $this->driver_name,
            'driverContact' => $this->driver_contact,
            'status' => $this->status,
            'transporter' => new TransporterResource($this->whenLoaded('transporter')),
        ];
    }
}
