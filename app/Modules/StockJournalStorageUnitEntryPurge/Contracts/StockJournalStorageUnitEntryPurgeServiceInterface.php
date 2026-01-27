<?php

namespace App\Modules\StockJournalStorageUnitEntryPurge\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournalStorageUnitEntryPurge\Models\StockJournalStorageUnitEntryPurge;

interface StockJournalStorageUnitEntryPurgeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournalStorageUnitEntryPurge;
    public function store(array $data): StockJournalStorageUnitEntryPurge;
    public function update(array $data, int $id): StockJournalStorageUnitEntryPurge;
    public function delete(int $id): bool;
}
