<?php

namespace App\Modules\Transporter\Resources;

use App\Modules\AccountLedger\Resources\AccountLedgerResource;
use App\Modules\Address\Resources\AddressResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class TransporterResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'gstin' => $this->gstin,
            'pan' => $this->pan,
            'licenseNo' => $this->license_no,
            'vehicleType' => $this->vehicle_type,
            'contactPerson' => $this->contact_person,
            'contactNo' => $this->contact_no,
            'phone' => $this->phone,
            'email' => $this->email,
            'status' => $this->status,
            'accountLedger' => AccountLedgerResource::make($this->whenLoaded('account_ledger')),
            'address' => AddressResource::make($this->whenLoaded('address')),
        ];
    }
}
