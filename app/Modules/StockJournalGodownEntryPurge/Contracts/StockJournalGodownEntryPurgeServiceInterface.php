<?php

namespace App\Modules\StockJournalGodownEntryPurge\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournalGodownEntryPurge\Models\StockJournalGodownEntryPurge;

interface StockJournalGodownEntryPurgeServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournalGodownEntryPurge;
    public function store(array $data): StockJournalGodownEntryPurge;
    public function update(array $data, int $id): StockJournalGodownEntryPurge;
    public function delete(int $id): bool;
}
