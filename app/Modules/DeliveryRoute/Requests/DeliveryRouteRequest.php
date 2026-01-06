<?php

namespace App\Modules\DeliveryRoute\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'transporter_id' => ['required', 'numeric', 'exists:transporters,id'],
            'source_place_id' => ['required', 'numeric', 'exists:godowns,id'],
            'destination_place_id' => ['required', 'numeric', 'exists:delivery_places,id'],
            'distance_km' => ['sometimes', 'nullable', 'numeric'],
            'rate' => ['sometimes', 'nullable', 'numeric'],
            'rate_unit_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_units,id'],
            'estimated_time_in_minutes' => ['sometimes', 'nullable', 'integer'],
            //check unique constraint for transporter_id, source_place_id, destination_place_id, vehicle_no
            'vehicle_no' => [
                'required',
                'string',
                'max:255',
                Rule::unique('delivery_routes')
                    ->where('transporter_id', $this->transporter_id)
                    ->where('source_place_id', $this->source_place_id)
                    ->where('destination_place_id', $this->destination_place_id),
            ],

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $routeId = $this->route('delivery_route');
            $rules['vehicle_no'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('delivery_routes')
                    ->where('transporter_id', $this->transporter_id)
                    ->where('source_place_id', $this->source_place_id)
                    ->where('destination_place_id', $this->destination_place_id)
                    ->ignore($routeId),
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'transporter_id.required' => 'The transporter field is required.',
            'transporter_id.numeric' => 'The transporter must be a number.',
            'transporter_id.exists' => 'The selected transporter is invalid.',
            'source_place_id.required' => 'The source place field is required.',
            'source_place_id.numeric' => 'The source place must be a number.',
            'source_place_id.exists' => 'The selected source place is invalid.',

            'destination_place_id.required' => 'The destination place field is required.',
            'destination_place_id.numeric' => 'The destination place must be a number.',
            'destination_place_id.exists' => 'The selected destination place is invalid.',
            'vehicle_no.required' => 'The vehicle number field is required.',
            'vehicle_no.string' => 'The vehicle number must be a string.',
            'vehicle_no.max' => 'The vehicle number may not be greater than 255 characters.',

            'distance_km.numeric' => 'The distance (km) must be a number.',

            'rate.numeric' => 'The rate must be a number.',
            'rate_unit_id.numeric' => 'The rate unit must be a number.',
            'rate_unit_id.exists' => 'The selected rate unit is invalid.',
        ];
    }
}
