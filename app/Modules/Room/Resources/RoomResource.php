<?php

namespace App\Modules\Room\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;

class RoomResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'roomNumber' => $this->room_number,
            'status' => $this->status,
        ];
    }
}
