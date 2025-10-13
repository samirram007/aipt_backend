<?php

namespace App\Modules\EmployeeGroup\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class EmployeeGroupResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code
        ];
    }
}
