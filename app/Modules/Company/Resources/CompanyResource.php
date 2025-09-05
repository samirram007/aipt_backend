<?php

namespace App\Modules\Company\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\CompanyType\Resources\CompanyTypeResource;
use App\Modules\FiscalYear\Resources\FiscalYearResource;
use Illuminate\Http\Request;


/**
 * @OA\Schema(
 *     schema="CompanyResource",
 *     title="Company Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Example Account Nature"),
 *     @OA\Property(property="code", type="string", example="EXAMPLE"),
 *     @OA\Property(property="address", type="string", example="123 Main St"),
 * @OA\Property(property="phone", type="string", example="1234567890"),
 * @OA\Property(property="email", type="string", example="info@example.com"),
 * @OA\Property(property="website", type="string", example="www.example.com"),
 * @OA\Property(property="companyTypeId", type="integer", example=1),
 * @OA\Property(property="fiscalYearId", type="integer", example=1),
 * @OA\Property(property="tin", type="string", example="1234567890"),
 * @OA\Property(property="vat", type="string", example="1234567890"),
 * @OA\Property(property="logo", type="string", example="logo.png"),
 * @OA\Property(property="currency", type="string", example="INR"),
 * @OA\Property(property="country", type="string", example="IN"),
 * @OA\Property(property="state", type="string", example="Maharashtra"),
 * @OA\Property(property="city", type="string", example="Mumbai"),
 * @OA\Property(property="zip", type="string", example="400001"),
 * @OA\Property(property="status", type="string", example="active"),
 *
 * )
 */
class CompanyResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'companyTypeId' => $this->company_type_id,
            'fiscalYearId' => $this->fiscal_year_id,
            'tin' => $this->tin,
            'vat' => $this->vat,
            'logo' => $this->logo,
            'currency' => $this->currency,
            'country' => $this->country,
            'state' => $this->state,
            'city' => $this->city,
            'zip' => $this->zip,
            'status' => $this->status,
            'companyType' => new CompanyTypeResource($this->whenLoaded('companyType')),
            'fiscalYear' => new FiscalYearResource($this->whenLoaded('fiscalYear')),

        ];
    }
}
