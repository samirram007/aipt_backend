<?php

namespace App\Modules\Agent\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class AgentResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        $data =  [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'contactNo' => $this->contact_no,
            'commissionPercent'=> $this->commission_percent,
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
        ];

        return array_filter($data, fn($value) => !is_null($value));
    }
}
