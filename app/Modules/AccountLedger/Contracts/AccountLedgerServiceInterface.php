<?php

namespace App\Modules\AccountLedger\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\AccountLedger\Models\AccountLedger;

interface AccountLedgerServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): AccountLedger;
    public function store(array $data): AccountLedger;
    public function update(array $data, int $id): AccountLedger;
    public function delete(int $id): bool;
    public function getPurchaseLedgers(): Collection;
    public function getSaleLedgers(): Collection;
    public function getSupplierLedgers(): Collection;
    public function getDistributorLedgers(): Collection;
    public function getStockInHandLedgers(): Collection;
}
