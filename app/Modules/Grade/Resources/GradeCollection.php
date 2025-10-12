<?php

namespace App\Modules\Grade\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class GradeCollection extends SuccessCollection
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
