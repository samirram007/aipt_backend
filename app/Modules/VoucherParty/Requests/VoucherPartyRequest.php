<?php

namespace App\Modules\VoucherParty\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherPartyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'mailing_name' => ['sometimes', 'required', 'string', 'max:255'],
            'address' => ['sometimes', 'required', 'string', 'max:500'],
            'state_id' => ['sometimes', 'required', 'integer', 'exists:states,id'],
            'country_id' => ['sometimes', 'required', 'integer', 'exists:countries,id'],
            'gst_registration_type_id' => ['sometimes', 'required', 'integer', 'exists:gst_registration_types,id'],
            'gstin' => ['sometimes', 'nullable', 'string', 'max:15'],
            'place_of_supply_state_id' => ['sometimes', 'nullable', 'integer', 'exists:states,id'],

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('voucher_party');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:voucher_parties,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:voucher_parties,code,' . $id,];

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
