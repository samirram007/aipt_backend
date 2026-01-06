<?php

namespace App\Modules\Doctor\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Address\Requests\AddressRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'doctor_id' => ['sometimes','nullable', 'uuid'],
            'email' => ['sometimes', 'nullable', 'email', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
            'designation_id' => ['sometimes', 'nullable', 'integer', 'exists:designations,id'],
            'department_id' => ['sometimes', 'nullable', 'integer', 'exists:departments,id'],
            'gender' => ['sometimes', 'nullable', 'in:male,female,other'],
            'dob' => ['sometimes', 'nullable', 'date'],
            'doj' => ['sometimes', 'nullable', 'date'],
            'image' => ['sometimes', 'nullable', 'string', 'max:255'],
            'contact_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
            'has_user_account' => ['sometimes', 'nullable', 'boolean'],
            'role_id' => 'nullable|exists:roles,id',
        ];

        $addressRules = collect((new AddressRequest())->rules())
            ->mapWithKeys(fn($rule, $key) => ["address.$key" => $rule])
            ->toArray();

        // Update request
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('doctor');

            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:doctors,name,' . $id];
            $rules['doctor_id'] = ['sometimes', 'required', 'uuid', 'unique:doctors,doctor_id,' . $id];
            $rules['email'] = ['sometimes', 'nullable', 'email', 'max:255', 'unique:doctors,email,' . $id];
        }

        return array_merge($rules, $addressRules);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',

            'doctor_id.required' => 'The doctor ID is required.',
            'doctor_id.uuid' => 'The doctor ID must be a valid UUID.',
            'doctor_id.unique' => 'The doctor ID has already been taken.',

            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',

            'designation_id.exists' => 'Invalid designation selected.',
            'department_id.exists' => 'Invalid department selected.',

            'gender.in' => 'Gender must be male, female, or other.',
            'dob.before' => 'Date of birth must be before today.',

            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
        ];
    }
}
