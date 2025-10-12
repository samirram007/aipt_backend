<?php

namespace App\Modules\Holiday\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class HolidayCollection extends SuccessCollection
{

         /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
