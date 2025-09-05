<?php

namespace App\Modules\VoucherCategory\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherCategoryResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'moduleLink' => $this->module_link,
            'status' => $this->status
        ];
    }
}
