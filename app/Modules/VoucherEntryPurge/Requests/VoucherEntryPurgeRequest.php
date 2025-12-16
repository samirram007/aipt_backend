<?php

namespace App\Modules\VoucherEntryPurge\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoucherEntryPurgeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'voucher_entry_id' => 'required|integer|exists:voucher_entries,id',
            'purged_by' => 'sometimes|required|integer|exists:users,id',
            'purged_at' => 'sometimes|required|date',
            'reason' => 'sometimes|nullable|string|max:500',
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('voucher_entry_purge');
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
