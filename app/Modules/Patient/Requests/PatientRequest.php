<?php

namespace App\Modules\Patient\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'code' => ['sometimes','nullable', 'string', 'max:255','unique:patients,code'],
            'status' => ['sometimes','required', 'string', 'max:255'],
            'contact_no' => ['nullable','string','max:13'],
            'age' => ['integer'],
            'gender' => ['string','in:male,female,others'],
            'agent_id' => ['sometimes','nullable','integer'],
            'physician_id' => ['sometimes','nullable','integer'],

            // address
            'address'=>['array'],
            'address.line1'=>['sometimes','nullable','string','max:255'],
            'address.line2' => ['sometimes','nullable','string','max:255'],
            'address.city' => ['sometimes','nullable','string','max:255'],
            'address.state_id' => ['sometimes','nullable','numeric'],
            'address.is_primary' => ['sometimes','nullable','boolean'],
            'address.postal_code'=>['sometimes','nullable','string']
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('patient');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255',];
            $rules['email'] = ['sometimes', 'required', 'string', 'max:255', "unique:patients,email,{$id}"];

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
