<?php

namespace App\Modules\TestItemReportTemplate\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestItemReportTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('test_item_report_template'); // current record id

        $rules = [
        'test_item_id' => ['required','numeric','exists:stock_items,id'],
        'doctor_id' => ['required','numeric','exists:employees,id'],
        'report_template_name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('test_item_report_templates')
                ->where(function ($query) {
                    return $query->where('doctor_id', $this->doctor_id)
                                    ->where('test_item_id', $this->test_item_id);
                })
                ->ignore($id) // ignore current record on update
        ],
        ];


        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('test_item_report_template');
            $rules['stock_item_id'] = ['required','numeric', 'exists:stock_items,id,' . $id,];
            $rules['employee_id'] = ['required','numeric', 'exists:employees,id,' . $id,];

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
