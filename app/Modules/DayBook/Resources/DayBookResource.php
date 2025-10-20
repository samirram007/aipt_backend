<?php

namespace App\Modules\DayBook\Resources;

use App\Modules\Voucher\Resources\VoucherResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DayBookResource extends VoucherResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
