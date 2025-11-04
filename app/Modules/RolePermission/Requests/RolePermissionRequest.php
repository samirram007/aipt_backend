<?php

namespace App\Modules\RolePermission\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'role_id' => ['required', 'numeric', 'exists:roles,id'],
            'app_module_feature_id' => ['required', 'numeric', 'exists:app_module_features,id'],
            'is_allowed' => ['required', 'boolean'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // $id = $this->route('role_permission');
            $rules['role_id'] = ['sometimes', 'numeric', 'exists:roles,id'];
            $rules['app_module_feature_id'] = ['sometimes', 'numeric', 'exists:app_module_features,id'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'is_allowed.required' => 'The is_allowed field is required.',
            'is_allowed.boolean' => 'The is_allowed field must be true or false.',
            'role_id.required' => 'The role_id field is required.',
            'role_id.numeric' => 'The role_id field must be a number.',
            'role_id.exists' => 'The selected role_id is invalid.',
            'app_module_feature_id.required' => 'The app_module_feature_id field is required.',
            'app_module_feature_id.numeric' => 'The app_module_feature_id field must be a number.',
            'app_module_feature_id.exists' => 'The selected app_module_feature_id is invalid.',
        ];
    }
}
