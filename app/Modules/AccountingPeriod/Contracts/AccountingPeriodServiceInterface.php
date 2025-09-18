<?php

namespace App\Modules\AccountingPeriod\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\AccountingPeriod\Models\AccountingPeriod;

interface AccountingPeriodServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?AccountingPeriod;
    public function store(array $data): AccountingPeriod;
    public function update(array $data, int $id): AccountingPeriod;
    public function delete(int $id): bool;
}
