<?php

namespace App\Modules\VoucherParty\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class VoucherPartyResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mailingName' => $this->mailing_name,
            'address' => $this->address,
            'stateId' => $this->state_id,
            'countryId' => $this->country_id,
            'gstRegistrationTypeId' => $this->gst_registration_type_id,
            'gstin' => $this->gstin,
            'placeOfSupplyStateId' => $this->place_of_supply_state_id
        ];

    }
}
