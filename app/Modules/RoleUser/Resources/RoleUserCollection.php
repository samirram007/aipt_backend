<?php

namespace App\Modules\RoleUser\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class RoleUserCollection extends SuccessCollection
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
