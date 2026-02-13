<?php

namespace App\Modules\Bed\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'beds' => ['required', 'array', 'min:1'],

            'beds.*.name' => ['required', 'string', 'max:255'],
            'beds.*.code' => ['required', 'string', 'max:255', 'distinct', 'unique:beds,code'],
            'beds.*.description' => ['nullable', 'string', 'max:255'],

            'beds.*.status' => [
                'required',
                'in:available,occupied,booked,maintenance,blocked,under_cleaning'
            ],

            'beds.*.room_id' => ['required', 'string', 'exists:facilities,id'],
        ];
        // $rules = [
        //     'name' => ['required', 'string', 'max:255', 'unique:beds,name'],
        //     'code' => ['sometimes', 'required', 'string', 'max:255', 'unique:beds,code'],
        //     'description' => ['sometimes', 'required', 'string', 'max:255'],
        //     'status' => ['sometimes', 'required', 'string', 'max:255'],
        //     'room_id' => ['required', 'string', 'exists:facilities,id']
        // ];

        // // For update requests, make validation more flexible
        // if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
        //     $id = $this->route('bed');
        //     $rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:beds,name,' . $id,];
        //     $rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:beds,code,' . $id,];
        // }

        // return $rules;
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
