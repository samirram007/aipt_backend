<?php

namespace App\Modules\Country\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:countries,name'],
            'phone_code' => ['required', 'string', 'max:255'],
            'iso_code' => ['required', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('country');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:countries,name,' . $id];
            // $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:countries,code,' . $id];

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
