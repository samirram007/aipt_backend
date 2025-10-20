<?php

namespace App\Modules\Employee\Requests;

use App\Modules\Address\Requests\AddressRequest;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['sometimes', 'nullable', 'string', 'max:255', 'unique:employees,code'],
            'dob' => ['sometimes', 'nullable', 'date'],
            'doj' => ['sometimes', 'nullable', 'date'],
            'email' => ['sometimes', 'nullable', 'string', 'max:255'],
            'contact_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'education' => ['sometimes', 'nullable', 'string', 'max:255'],
            'pan' => ['sometimes', 'nullable', 'string', 'max:255'],
            'department_id' => ['sometimes', 'nullable', 'exists:departments,id'],
            'designation_id' => ['sometimes', 'nullable', 'exists:designations,id'],
            'account_group_id' => ['sometimes', 'nullable', 'exists:account_groups,id'],
            'employee_group_id' => ['sometimes', 'nullable', 'exists:employee_groups,id'],
            'shift_id' => ['sometimes', 'nullable', 'exists:shifts,id'],
            'grade_id' => ['sometimes', 'nullable', 'exists:grades,id'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
            'image' => ['sometimes', 'nullable', 'string', 'max:255'],
            'has_user_account' => ['sometimes', 'nullable', 'boolean'],
        ];
        //return $rules;
        $addressRules = collect((new AddressRequest())->rules())
            ->mapWithKeys(fn($rule, $key) => ["address.$key" => $rule])
            ->toArray();


        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('employee');
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:employees,code,' . $id,];

        }
        // dd($rules, $addressRules);

        return array_merge($rules, $addressRules);

    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a string.',
            'code.max' => 'The code may not be greater than 255 characters.',
            'code.unique' => 'The code has already been taken.',
            'description.required   ' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
        ];
    }
}
