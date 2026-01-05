<?php

namespace App\Modules\DeliveryVehicle\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'transporter_id' => ['required', 'numeric', 'exists:transporters,id'],
            'vehicle_number' => ['sometimes', 'required', 'string', 'max:255', 'unique:delivery_vehicles,vehicle_number'],
            'vehicle_type' => ['sometimes', 'required', 'string', 'max:255'],
            'capacity' => ['sometimes', 'nullable', 'string', 'max:255'],
            'driver_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'driver_contact' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('delivery_vehicle');
            $rules['vehicle_number'] = ['sometimes', 'required', 'string', 'max:255', 'unique:delivery_vehicles,vehicle_number,' . $id,];

        }

        return $rules;
    }

    public function messages(): array
    {
        return [

        ];
    }
}
