<?php

namespace App\Modules\UserFiscalYear\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\UserFiscalYear\Models\UserFiscalYear;

interface UserFiscalYearServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?UserFiscalYear;
    public function getByUserId(int $userId): ?UserFiscalYear;
    public function store(array $data): UserFiscalYear;
    public function saveReportingPeriod(array $data): UserFiscalYear;
    public function update(array $data, int $id): UserFiscalYear;
    public function delete(int $id): bool;
}
