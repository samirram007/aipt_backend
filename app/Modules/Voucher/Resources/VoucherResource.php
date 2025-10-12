<?php

namespace App\Modules\Voucher\Resources;

use App\Http\Resources\SuccessResource;
use App\Modules\Company\Resources\CompanyResource;
use App\Modules\FiscalYear\Resources\FiscalYearResource;
use App\Modules\StockJournal\Resources\StockJournalResource;
use App\Modules\VoucherEntry\Resources\VoucherEntryResource;
use App\Modules\VoucherReference\Resources\VoucherReferenceResource;
use App\Modules\VoucherType\Resources\VoucherTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'voucherNo' => $this->voucher_no,
            'voucherDate' => $this->voucher_date,
            'voucherTypeId' => $this->voucher_type_id,
            'remarks' => $this->remarks,
            'status' => $this->status,
            'fiscalYearId' => $this->fiscal_year_id,
            'companyId' => $this->company_id,
            'stockJournalId' => $this->stock_journal_id,
            'createdAt' => $this->created_at?->toISOString(),
            'updatedAt' => $this->updated_at?->toISOString(),
            'company' => CompanyResource::make($this->whenLoaded('company')),
            'voucherType' => VoucherTypeResource::make($this->whenLoaded('voucher_type')),
            'fiscalYear' => FiscalYearResource::make($this->whenLoaded('fiscal_year')),
            'stockJournal' => StockJournalResource::make($this->whenLoaded('stock_journal')),
            'voucherEntries' => VoucherEntryResource::collection($this->whenLoaded('voucher_entries')),
            'voucherReference' => VoucherReferenceResource::collection($this->whenLoaded('voucher_references')),
        ];
    }
}
