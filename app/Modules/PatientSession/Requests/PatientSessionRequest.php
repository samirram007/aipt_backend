<?php

namespace App\Modules\PatientSession\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'patient_id' => ['required', 'uuid'],
            'doctor_id' => ['sometimes','nullable','uuid'],
            'session_type' => ['sometimes','nullable','string', 'max:255'],
            'session_start_time' => ['sometimes','nullable','datetime'],
            'session_close_time' => ['sometimes','nullable','datetime'],
            'status' => ['sometimes','nullable', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('patient_session');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:patient_sessions,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:patient_sessions,code,' . $id,];

        }

        return $rules;
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