<?php

namespace App\Modules\TreatmentMaster\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class TreatmentMasterResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'defaultCost' => $this->default_cost,
            'status' => $this->status,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
