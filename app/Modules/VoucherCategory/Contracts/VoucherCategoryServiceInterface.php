<?php

namespace App\Modules\VoucherCategory\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\VoucherCategory\Models\VoucherCategory;

interface VoucherCategoryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?VoucherCategory;
    public function store(array $data): VoucherCategory;
    public function update(array $data, int $id): VoucherCategory;
    public function delete(int $id): bool;
}
