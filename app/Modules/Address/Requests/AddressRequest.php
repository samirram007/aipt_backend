<?php

namespace App\Modules\Address\Requests;

use App\Enums\AddressType;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $rules = [
            'id' => ['sometimes', 'nullable', 'numeric', 'exists:addresses,id'],
            'line1' => ['required', 'string', 'max:255'],
            'line2' => ['sometimes', 'nullable', 'string', 'max:255'],
            'landmark' => ['sometimes', 'nullable', 'string', 'max:255'],
            'city' => ['sometimes', 'nullable', 'string', 'max:100'],
            'state_id' => ['sometimes', 'nullable', 'exists:states,id'],
            'country_id' => ['sometimes', 'nullable', 'exists:countries,id'],
            'postal_code' => ['sometimes', 'nullable', 'string', 'max:6'],
            'latitude' => ['sometimes', 'nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['sometimes', 'nullable', 'numeric', 'between:-180,180'],
            'address_type' => ['sometimes', 'nullable', 'string', 'max:255'],
            // 'address_type' => ['sometimes', 'nullable', 'in:' . implode(',', array_column(AddressType::cases(), 'value'))],
            'is_primary' => ['sometimes', 'boolean'],
        ];

        // For update requests, allow ignoring the current address id
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $addressId = $this->route('address');
            $rules['id'] = ['sometimes', 'nullable', 'numeric', 'exists:addresses,id'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'line1.required' => 'Address Line 1 is required.',
            'line1.string' => 'Address Line 1 must be a string.',
            'line1.max' => 'Address Line 1 may not exceed 255 characters.',

            'line2.string' => 'Address Line 2 must be a string.',
            'line2.max' => 'Address Line 2 may not exceed 255 characters.',

            'landmark.string' => 'Landmark must be a string.',
            'landmark.max' => 'Landmark may not exceed 255 characters.',

            'city.required' => 'City is required.',
            'city.string' => 'City must be a string.',
            'city.max' => 'City may not exceed 100 characters.',

            'state_id.required' => 'State is required.',
            'state_id.exists' => 'Selected state is invalid.',

            'country_id.required' => 'Country is required.',
            'country_id.exists' => 'Selected country is invalid.',

            'postal_code.required' => 'Postal code is required.',
            'postal_code.string' => 'Postal code must be a string.',
            'postal_code.max' => 'Postal code may not exceed 6 characters.',

            'latitude.numeric' => 'Latitude must be a valid number.',
            'latitude.between' => 'Latitude must be between -90 and 90.',

            'longitude.numeric' => 'Longitude must be a valid number.',
            'longitude.between' => 'Longitude must be between -180 and 180.',

            'address_type.required' => 'Address type is required.',
            'address_type.in' => 'Address type must be one of: ' . implode(', ', array_column(AddressType::cases(), 'value')),

            'is_primary.boolean' => 'Is primary must be true or false.',
        ];
    }
}
