<?php

namespace App\Modules\Vehicle\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'transporter_id' => ['required', 'exists:transporters,id'],
            'vehicle_type' => ['sometimes', 'nullable', 'string', 'max:255',],
            'vehicle_no' => ['required', 'string', 'max:255', 'unique:vehicles,vehicle_no'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:50'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('vehicle');
            $rules['vehicle_no'] = ['required', 'string', 'max:255', 'unique:vehicles,vehicle_no,' . $id];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'transporter_id.required' => 'Transporter is required.',
            'transporter_id.exists' => 'The selected transporter does not exist.',
            'vehicle_type.string' => 'Vehicle type must be a string.',
            'vehicle_type.max' => 'Vehicle type may not be greater than 255 characters.',
            'vehicle_no.required' => 'Vehicle number is required.',
            'vehicle_no.string' => 'Vehicle number must be a string.',
            'vehicle_no.max' => 'Vehicle number may not be greater than 255 characters.',
            'vehicle_no.unique' => 'The vehicle number has already been taken.',
            'description.string' => 'Description must be a string.',
            'description.max' => 'Description may not be greater than 255 characters.',
            'status.required' => 'Status is required.',
            'status.string' => 'Status must be a string.',
            'status.max' => 'Status may not be greater than 50 characters.',
        ];
    }
}
