<?php

namespace App\Modules\TestBooking\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'booking_date' => ['required', 'date'],
            'patient_id' => ['required', 'numeric','exists:patients,id'],
            'agent_id' => ['sometimes','required','numeric','exists:agents,id'],
            'physician_id' => ['sometimes','required','numeric','exists:physicians,id'],

            'tests.*'=>['array'],
            'tests.*.test_id'=> ['required','numeric','exists:stock_items,id'],
            'tests.*.test_date' => ['required','date'],
            'tests.*.report_date' => ['required','date'],
            'tests.*.amount' => ['required','string'],

            'discount_type_id'=> ['sometimes','nullable','numeric']
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('test_booking');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:test_bookings,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:test_bookings,code,' . $id,];

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
