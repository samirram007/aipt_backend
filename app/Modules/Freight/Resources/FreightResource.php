<?php

namespace App\Modules\Freight\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class FreightResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'deliveryNoteId' => $this->delivery_note_id,
            'distance' => $this->distance,
            'rate' => $this->rate,
            'distanceUnitId' => $this->distance_unit_id,
            'rateUnitId' => $this->rate_unit_id,
            'quantity' => $this->quantity,
            'weight' => $this->weight,
            'volume' => $this->volume,
            'loadingCharges' => $this->loading_charges,
            'unloadingCharges' => $this->unloading_charges,
            'packingCharges' => $this->packing_charges,
            'insuranceCharges' => $this->insurance_charges,
            'otherCharges' => $this->other_charges,
            'freightCharges' => $this->freight_charges,
            'totalFare' => $this->total_fare,
        ];
    }
}
