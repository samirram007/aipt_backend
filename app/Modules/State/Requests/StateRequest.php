<?php

namespace App\Modules\State\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:states,name'],
            'code' => ['required', 'string', 'max:255', 'unique:states,code,'],
            'country_id' => ['required', 'string', 'max:255'],
            'gst_code' => ['sometimes', 'required', 'string', 'max:255'],


        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('state');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:states,name,' . $id];

        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
        ];
    }
}
