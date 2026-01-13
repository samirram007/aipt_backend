<?php

namespace App\Modules\PatientMedicalHistory\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class PatientMedicalHistoryCollection extends SuccessCollection
{

         /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
