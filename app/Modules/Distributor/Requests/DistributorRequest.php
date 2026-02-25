<?php

namespace App\Modules\Distributor\Requests;

use App\Modules\Address\Requests\AddressRequest;
use Illuminate\Foundation\Http\FormRequest;

class DistributorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['sometimes', 'nullable', 'string', 'max:255', 'unique:distributors,code'],
            'gstin' => ['sometimes', 'nullable', 'string', 'max:25'],
            'pan' => ['sometimes', 'nullable', 'string', 'max:20'],
            'contact_person' => ['sometimes', 'nullable', 'string', 'max:100'],
            'contact_no' => ['sometimes', 'nullable', 'string', 'max:20'],
            'phone' => ['sometimes', 'nullable', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status' => ['sometimes', 'nullable', 'string', 'max:255'],
            'account_group_id' => ['sometimes', 'required', 'exists:account_groups,id'],
            'gst_registration_type_id' => ['sometimes', 'nullable', 'exists:gst_registration_types,id'],
            // 'address' => ['sometimes', 'required', new AddressRequest()]
        ];
        $addressRules = collect((new AddressRequest())->rules())
            ->mapWithKeys(fn($rule, $key) => ["address.$key" => $rule])
            ->toArray();
        //dd(array_merge($rules, $addressRules));
        // // For update requests, make validation more flexible
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->route('distributor');
            $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:distributors,code,' . $id,];

        }
        // dd($rules['address']);
        //return $rules;
        return array_merge($rules, $addressRules);

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
