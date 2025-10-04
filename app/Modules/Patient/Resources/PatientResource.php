<?php

namespace App\Modules\Patient\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\Agent\Resources\AgentResource;
use App\Modules\Physician\Resources\PhysicianResource;
use App\Modules\Address\Resources\AddressResource;


class PatientResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'contactNo'=> $this->contact_no,
            'gender'=> $this->gender,
            'status'=> $this->status,
            'agentId'=> $this->agent_id,
            'physicianId'=> $this->physician_id,
            'accountLedgerId'=> $this->account_ledger_id,
            'agent'       => new AgentResource($this->whenLoaded('agent')),
            'physician'   => new PhysicianResource($this->whenLoaded('physician')),
            'address' => new AddressResource($this->whenLoaded('address')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
