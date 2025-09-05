<?php

namespace App\Modules\CompanyType\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\Company\Resources\CompanyCollection;
use Illuminate\Http\Request;


/**
 * @OA\Schema(
 *     schema="CompanyTypeResource",
 *     title="Account Nature Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Example Account Nature"),
 *     @OA\Property(property="code", type="string", example="EXAMPLE"),
 *     @OA\Property(property="description", type="string", example="This is an example account nature."),
 *     @OA\Property(property="companies", type="array", @OA\Items(ref="#/components/schemas/CompanyResource")),
 * )
 */
class CompanyTypeResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'companies' => new CompanyCollection($this->whenLoaded('companies')),
        ];
    }
}
