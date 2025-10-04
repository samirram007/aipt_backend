<?php

namespace App\Modules\Physician\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhysicianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'degree'=>['sometimes','nullable','string'],
            'email'=>['nullable','string','email:physicians,email'],
            'contact_no' => ['sometimes','nullable','string'],
            'discipline_id' => ['sometimes','nullable','numeric'],
            'is_active' => ['sometimes','nullable','boolean']
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('physician');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:physicians,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:physicians,code,' . $id,];

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
