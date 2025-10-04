<?php

namespace App\Modules\Discipline\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class DisciplineResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
