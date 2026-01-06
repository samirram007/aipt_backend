<?php

namespace App\Modules\Doctor\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Department\Resources\DepartmentResource;
use App\Modules\Designation\Resources\DesignationResource;
use App\Modules\Address\Resources\AddressResource;
use App\Modules\User\Resources\UserResource;
class DoctorResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'doctorId' => $this->doctor_id,
            'dob' => $this->dob,
            'doj' => $this->doj,
            'email' => $this->email,
            'contactNo' => $this->contact_no,
            'image' => $this->image,
            'status' => $this->status,
            'departmentId' => $this->department_id,
            'designationId' => $this->designation_id,
            'department' => DepartmentResource::make($this->whenLoaded('department')),
            'designation' => DesignationResource::make($this->whenLoaded('designation')),
            'address' => AddressResource::make($this->whenLoaded('address')),
            'user' => UserResource::make($this->whenLoaded('user')),

        ];
    }
}