<?php

namespace App\Modules\AccountGroup\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="AccountGroupRequest",
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="The name of the account group"
 *     ),
 *     @OA\Property(
 *         property="code",
 *         type="string",
 *         description="The code of the account group"
 *     ),
 *     @OA\Property(
 *         property="account_nature_id",
 *         type="integer",
 *         description="The ID of the account nature associated with the account group"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="The description of the account group"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="boolean",
 *         description="The status of the account group"
 *     ),
 *     @OA\Property(
 *         property="icon",
 *         type="string",
 *         description="The icon of the account group"
 *     )
 * )
 */

class AccountGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required','string', 'max:255','unique:account_groups'],
            'code' => ['sometimes'],
            'account_nature_id' => ['sometimes', 'nullable', 'numeric', 'exists:account_natures,id'],
            'description' => ['sometimes'],
            'status' => ['sometimes'],
            'icon' => ['sometimes'],
        ];

        // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['name'] =['sometimes', 'required', 'string', 'max:255', 'unique:account_groups,name,' . $this->route('account_group')];
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
