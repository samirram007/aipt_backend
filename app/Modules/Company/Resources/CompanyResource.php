<?php

namespace App\Modules\Company\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\CompanyType\Resources\CompanyTypeResource;
use App\Modules\Country\Resources\CountryResource;
use App\Modules\Currency\Resources\CurrencyResource;
use App\Modules\FiscalYear\Resources\FiscalYearCollection;
use App\Modules\FiscalYear\Resources\FiscalYearResource;
use App\Modules\State\Resources\StateResource;
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
            'mailingName' => $this->mailing_name,
            'code' => $this->code,
            'address' => $this->address,
            'phoneNo' => $this->phone_no,
            'mobileNo' => $this->phone_no,
            'email' => $this->email,
            'website' => $this->website,
            'cinNo' => $this->cin_no,
            'tinNo' => $this->tin_no,
            'tanNo' => $this->tan_no,
            'gstNo' => $this->tin_no,
            'panNo' => $this->vat,
            'logo' => $this->logo,
            'currencyId' => $this->currency_id,
            'currency' => new CurrencyResource($this->whenLoaded('currency')),

            'countryId' => $this->country_id,
            'country' => new CountryResource($this->whenLoaded('country')),

            'stateId' => $this->state_id,
            'state' => new StateResource($this->whenLoaded('state')),
            'city' => $this->city,
            'zipCode' => $this->zip_code,
            'status' => $this->status,
            'isGroupCompany' => $this->is_group_company,
            'companyTypeId' => $this->company_type_id,
            'companyType' => new CompanyTypeResource($this->whenLoaded('company_type')),
            'fiscalYears' => new FiscalYearCollection($this->whenLoaded('fiscal_years')),

        ];
    }
}
