<?php

namespace App\Modules\Employee\Resources;

use App\Modules\Address\Resources\AddressResource;
use App\Modules\Department\Resources\DepartmentResource;
use App\Modules\Designation\Resources\DesignationResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class EmployeeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'dob' => $this->dob,
            'doj' => $this->doj,
            'email' => $this->email,
            'contactNo' => $this->contact_no,
            'education' => $this->education,
            'pan' => $this->pan,
            'image' => $this->image,
            'status' => $this->status,
            'departmentId' => $this->department_id,
            'designationId' => $this->designation_id,
            'department' => DepartmentResource::make($this->whenLoaded('department')),
            'designation' => DesignationResource::make($this->whenLoaded('designation')),
            'address' => AddressResource::make($this->whenLoaded('address')),

        ];
    }
}
