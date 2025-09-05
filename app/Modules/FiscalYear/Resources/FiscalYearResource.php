<?php

namespace App\Modules\FiscalYear\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
/**
 * @OA\Schema(
 *     schema="FiscalYearResource",
 *     title="FiscalYear Resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Fiscal Year 2025-26"),
 *     @OA\Property(property="start_date", type="string", example="2025-04-01"),
 *     @OA\Property(property="end_date", type="string", example="2026-03-31"),
 * )
 */
class FiscalYearResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
