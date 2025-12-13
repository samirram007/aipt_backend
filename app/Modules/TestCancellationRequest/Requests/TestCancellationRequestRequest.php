<?php

namespace App\Modules\TestCancellationRequest\Requests;

use App\Enums\TestCancellation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestCancellationRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'stock_journal_entry_id' => ['required', 'numeric', 'exists:stock_journal_entries,id'],
            'status' => ['required', Rule::enum(TestCancellation::class)],
            'remarks' => ['nullable', 'string']
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('test_cancellation_request');
            $rules['stock_journal_entry_id'] = ['nullable', 'numeric'];
            $rules['status'] = ['required', Rule::enum(TestCancellation::class)];
            $rules['remarks'] = ['nullable', 'string', 'max:255'];
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
