<?php

namespace App\Modules\VoucherNo\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherNo\Models\VoucherNo;

interface VoucherNoServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherNo;
    public function store(array $data): VoucherNo;
    public function update(array $data, int $id): VoucherNo;
    public function delete(int $id): bool;
    public function getVoucherNo(int $voucher_type_id, int $company_id, int $branch_id, int $fiscal_year_id): ?string;
}
