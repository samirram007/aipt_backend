<?php

namespace App\Modules\Patient\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Address\Requests\AddressRequest;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'patient_id' => ['sometimes','nullable', 'uuid'],
            'email' => ['sometimes', 'nullable', 'email', 'max:255'],
            'gender' => ['sometimes', 'nullable', 'in:male,female,other'],
            'dob' => ['sometimes', 'nullable', 'date'],
            'blood_group' => ['sometimes', 'nullable', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'image' => ['sometimes', 'nullable', 'string', 'max:255'],
            'contact_no' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
        ];

        $addressRules = collect((new AddressRequest())->rules())
            ->mapWithKeys(fn($rule, $key) => ["address.$key" => $rule])
            ->toArray();

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('patient');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:patients,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:patients,code,' . $id,];

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
