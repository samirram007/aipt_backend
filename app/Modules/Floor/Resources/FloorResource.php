<?php

namespace App\Modules\Floor\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;

class FloorResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'status' => $this->status,
            'floorNumber' => $this->floor_number,
        ];
    }
}
