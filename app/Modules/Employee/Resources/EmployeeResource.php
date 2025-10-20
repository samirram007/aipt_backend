<?php

namespace App\Modules\Employee\Resources;

use App\Modules\Address\Resources\AddressResource;
use App\Modules\Department\Resources\DepartmentResource;
use App\Modules\Designation\Resources\DesignationResource;
use App\Modules\EmployeeGroup\Resources\EmployeeGroupResource;
use App\Modules\Grade\Resources\GradeResource;
use App\Modules\Shift\Resources\ShiftResource;
use App\Modules\User\Resources\UserResource;
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
            'employeeGroupId' => $this->employee_group_id,
            'shiftId' => $this->shift_id,
            'gradeId' => $this->grade_id,
            'department' => DepartmentResource::make($this->whenLoaded('department')),
            'designation' => DesignationResource::make($this->whenLoaded('designation')),
            'employeeGroup' => EmployeeGroupResource::make($this->whenLoaded('employee_group')),
            'shift' => ShiftResource::make($this->whenLoaded('shift')),
            'grade' => GradeResource::make($this->whenLoaded('grade')),
            'address' => AddressResource::make($this->whenLoaded('address')),
            'user' => UserResource::make($this->whenLoaded('user')),

        ];
    }
}
