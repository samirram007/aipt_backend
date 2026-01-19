<?php

namespace App\Modules\CapitalItemMaintenanceLog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapitalItemMaintenanceLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255','unique:capital_item_maintenance_logs,name'],
            'code' => ['sometimes','required', 'string', 'max:255','unique:capital_item_maintenance_logs,code'],
            'description' => ['sometimes','required', 'string', 'max:255'],
            'status' => ['sometimes','required', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id=$this->route('capital_item_maintenance_log');
            $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:capital_item_maintenance_logs,name,' . $id,];
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:capital_item_maintenance_logs,code,' . $id,];

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
