<?php

namespace App\Modules\VoucherDispatchDetail\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherDispatchDetailResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherId' => $this->voucher_id,
            'orderNumber' => $this->order_number,
            'paymentTerms' => $this->payment_terms,
            'otherReferences' => $this->other_references,
            'termsOfDelivery' => $this->terms_of_delivery,
            'receiptDocNo' => $this->receipt_doc_no,
            'dispatchedThrough' => $this->dispatched_through,
            'destination' => $this->destination,
            'carrierName' => $this->carrier_name,
            'billOfLadingNo' => $this->bill_of_lading_no,
            'billOfLadingDate' => $this->bill_of_lading_date,
            'motorVehicleNo' => $this->motor_vehicle_no,
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
