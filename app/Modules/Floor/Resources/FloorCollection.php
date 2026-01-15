<?php

namespace App\Modules\Floor\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class FloorCollection extends SuccessCollection
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
