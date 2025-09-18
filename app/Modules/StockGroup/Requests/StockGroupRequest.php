<?php

namespace App\Modules\StockGroup\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {


        $rules = [

            'name' => ['required', 'string', 'max:255', 'unique:stock_groups,name'],
            'code' => ['sometimes', 'required', 'string', 'max:255', 'unique:stock_groups,code'],
            'description' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['sometimes', 'required', 'string', 'max:255'],
            'parent_id' => ['sometimes', 'nullable', 'numeric', 'exists:stock_groups,id'],
            'should_quantities_of_items_be_added' => ['sometimes', 'boolean']

        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('stock_group');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_groups,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:stock_groups,code,' . $id,];

        }
        // dd($rules, "rules");
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
