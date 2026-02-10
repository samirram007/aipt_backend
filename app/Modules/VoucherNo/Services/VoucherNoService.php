<?php

namespace App\Modules\VoucherNo\Services;

use App\Modules\VoucherNo\Contracts\VoucherNoServiceInterface;
use App\Modules\VoucherNo\Models\VoucherNo;
use App\Modules\VoucherType\Models\VoucherType;
use Illuminate\Database\Eloquent\Collection;

class VoucherNoService implements VoucherNoServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return VoucherNo::with($this->resource)->get();
    }

    public function getById(int $id): ?VoucherNo
    {
        return VoucherNo::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): VoucherNo
    {
        return VoucherNo::create($data);
    }

    public function update(array $data, int $id): VoucherNo
    {
        $record = VoucherNo::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = VoucherNo::findOrFail($id);
        return $record->delete();
    }
    public function getVoucherNo(int $voucher_type_id, int $company_id, int $fiscal_year_id, ?int $branch_id = null): ?string
    {
        $voucherNoRecord = VoucherNo::where('voucher_type_id', $voucher_type_id)
            ->where('company_id', $company_id)
            ->where('branch_id', $branch_id)
            ->where('fiscal_year_id', $fiscal_year_id)
            ->first();
        if ($voucherNoRecord) {
            $voucherNoRecord->current_no += 1;
            $voucherNoRecord->save();
        } else {
            $prefix = VoucherType::find($voucher_type_id)->code;
            $voucherNoRecord = new VoucherNo([
                'prefix' => substr($prefix, 0, 4) . '-',
                'voucher_type_id' => $voucher_type_id,
                'company_id' => $company_id,
                'branch_id' => $branch_id ?? null,
                'fiscal_year_id' => $fiscal_year_id,
                'starting_no' => 1,
                'current_no' => 1,
            ]);
            $voucherNoRecord->save();
        }


        return $voucherNoRecord ? $voucherNoRecord->prefix . $voucherNoRecord->current_no : null;
    }
}
