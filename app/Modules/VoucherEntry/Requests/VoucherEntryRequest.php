<?php

namespace App\Modules\VoucherEntry\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'voucher_id' => ['required', 'numeric'],
            'entry_order' => ['sometimes', 'nullable', 'numeric'],
            'account_ledger_id' => ['required', 'numeric'],
            'debit' => ['sometimes', 'nullable', 'numeric'],
            'credit' => ['sometimes', 'nullable', 'numeric'],
            'remarks' => ['sometimes', 'required', 'string', 'max:255'],

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('voucher_entry');
            // $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:voucher_entries,name,' . $id,];
            // $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:voucher_entries,code,' . $id,];

        }

        return $rules;
    }

    public function messages(): array
    {
        return [

        ];
    }
}
