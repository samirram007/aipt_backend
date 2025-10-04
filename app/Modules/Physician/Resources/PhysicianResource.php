<?php

namespace App\Modules\Physician\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Discipline\Resources\DisciplineResource;

class PhysicianResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        $data =  [
            'id' => $this->id,
            'name' => $this->name,
            'contactNo' => $this->contact_no,
            'email' => $this->email,
            'degree' => $this->degree,
            'disciplineId' => $this->discipline_id,
            'discipline'=> new DisciplineResource($this->whenLoaded('discipline')),
        ];
        return array_filter($data, fn($value) => !is_null($value));
    }
}
