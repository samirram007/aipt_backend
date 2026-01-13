<?php

namespace App\Modules\Patient\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Address\Resources\AddressResource;
use App\Modules\User\Resources\UserResource;
class PatientResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'patientId' => $this->patient_id,
            'dob' => $this->dob,
            'bloodGroup' => $this->blood_group,
            'gender' => $this->gender,
            'email' => $this->email,
            'contactNo' => $this->contact_no,
            'image' => $this->image,
            'status' => $this->status,
            'address' =>  AddressResource::make($this->whenLoaded('address')),
        ];
    }
}
