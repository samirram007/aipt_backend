<?php

namespace App\Modules\TestBooking\Requests;


use Illuminate\Foundation\Http\FormRequest;


class TestCancelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules =  [
            'remark' => ['nullable', 'string', 'max:500'],
        ];

        return $rules;
    }
}
