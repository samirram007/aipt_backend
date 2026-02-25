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
            'voucher_id' => ['required', 'numeric', 'exists:vouchers,id'],
            'name' => ['required', 'string', 'max:255'],
            'mailing_name' => ['sometimes', 'required', 'string', 'max:255'],
            'line1' => ['sometimes', 'nullable', 'string', 'max:500'],
            'line2' => ['sometimes', 'nullable', 'string', 'max:500'],
            'line3' => ['sometimes', 'nullable', 'string', 'max:500'],
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
        ];
    }
}
