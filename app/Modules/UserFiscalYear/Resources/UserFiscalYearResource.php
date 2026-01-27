<?php

namespace App\Modules\UserFiscalYear\Resources;

use App\Modules\FiscalYear\Resources\FiscalYearResource;
use App\Modules\User\Resources\UserResource;
use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class UserFiscalYearResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'fiscalYearId' => $this->fiscal_year_id,
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'currentDate' => $this->current_date ?? now(),
            'user' => UserResource::make($this->whenLoaded('user')),
            'fiscalYear' => FiscalYearResource::make($this->whenLoaded('fiscal_year')),
        ];
    }
}
