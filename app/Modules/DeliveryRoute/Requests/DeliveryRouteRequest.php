<?php

namespace App\Modules\DeliveryRoute\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'source_place_id' => ['required', 'numeric', 'exists:delivery_places,id'],
            'destination_place_id' => ['required', 'numeric', 'exists:delivery_places,id'],
            'distance_km' => ['sometimes', 'nullable', 'numeric'],
            'rate' => ['sometimes', 'nullable', 'numeric'],
            'estimated_time_in_minutes' => ['sometimes', 'nullable', 'integer'],

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('delivery_route');

        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'source_place_id.required' => 'The source place field is required.',
            'source_place_id.numeric' => 'The source place must be a number.',
            'source_place_id.exists' => 'The selected source place is invalid.',

            'destination_place_id.required' => 'The destination place field is required.',
            'destination_place_id.numeric' => 'The destination place must be a number.',
            'destination_place_id.exists' => 'The selected destination place is invalid.',

            'distance_km.numeric' => 'The distance (km) must be a number.',

            'rate.numeric' => 'The rate must be a number.',
        ];
    }
}
