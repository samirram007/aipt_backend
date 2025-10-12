<?php

namespace App\Modules\JobOrder\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class JobOrderResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patientId' => $this->patient_id,
            'voucherId' => $this->voucher_id,
            'status'=> $this->status,
            'paymentStatus' => $this->payment_status,
            'bookedDate' => $this->booked_date,
            'expectedDeliveryDate' => $this->expected_delivery_date,
            'report_generated_date' => $this->report_generated_date,
            'report_delivered_date' => $this->report_delivered_date,
            'cancelled_date' => $this->cancelled_date,
            'report_file_path' => $this->report_file_path,
            'remarks' => $this->remarks
        ];
    }
}
