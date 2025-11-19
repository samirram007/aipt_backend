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

        ];
    }
}
