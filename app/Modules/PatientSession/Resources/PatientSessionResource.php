<?php

namespace App\Modules\PatientSession\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Patient\Resources\PatientResource;
use App\Modules\Doctor\Resources\DoctorResource;
class PatientSessionResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'patientId' => $this->patient_id,
            'doctorId' => $this->doctor_id,
            'sessionType' => $this->session_type,
            'sessionStartTime' => $this->session_start_time?->toISOString(),
            'sessionCloseTime' => $this->session_close_time?->toISOString(),
            'status' => $this->status,
            'patient' => PatientResource::make($this->whenLoaded('patient')),
            'doctor' => DoctorResource::make($this->whenLoaded('doctor')),

        ];
    }
}
