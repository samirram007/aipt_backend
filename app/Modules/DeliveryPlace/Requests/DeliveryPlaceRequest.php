<?php

namespace App\Modules\DeliveryPlace\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryPlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', 'unique:delivery_places,name'],
            'code' => ['sometimes', 'required', 'string', 'max:255', 'unique:delivery_places,code'],
            'place_type' => ['sometimes', 'nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'nullable', 'boolean'],
            'remarks' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('delivery_place');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:delivery_places,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:delivery_places,code,' . $id,];
            $rules['place_type'] = ['sometimes', 'nullable', 'string', 'max:255'];
            $rules['is_active'] = ['sometimes', 'nullable', 'boolean'];
            $rules['remarks'] = ['sometimes', 'nullable', 'string', 'max:255'];
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
