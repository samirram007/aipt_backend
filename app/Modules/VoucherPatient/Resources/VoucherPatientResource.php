<?php

namespace App\Modules\VoucherPatient\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Address\Resources\AddressResource;
use App\Modules\Agent\Resources\AgentResource;
use App\Modules\Patient\Resources\PatientResource;
use App\Modules\Physician\Resources\PhysicianResource;
use App\Modules\Voucher\Resources\VoucherResource;

class VoucherPatientResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherId' => $this->voucher_id,
            'patientId' => $this->patient_id,
            'agentId' => $this->agent_id,
            'physicianId' => $this->physician_id,
            'voucher' => VoucherResource::make($this->whenLoaded('voucher')),
            'patient' => PatientResource::make($this->whenLoaded('patient')),
            'agent' => AgentResource::make($this->whenLoaded('agent')),
            'physician' => PhysicianResource::make($this->whenLoaded('physician')),
            'address' => AddressResource::make($this->whenLoaded('address'))
        ];
    }
}
