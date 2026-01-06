<?php

namespace App\Modules\Patient\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class PatientResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'patientId' => $this->patient_id,
            'dob' => $this->dob,
            'email' => $this->email,
            'contactNo' => $this->contact_no,
            'image' => $this->image,
            'status' => $this->status,

        ];
    }
}