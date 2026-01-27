<?php

namespace App\Modules\StockJournalGodownEntry\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;

interface StockJournalGodownEntryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournalGodownEntry;
    public function store(array $data): StockJournalGodownEntry;
    public function update(array $data, int $id): StockJournalGodownEntry;
    public function delete(int $id): bool;
    public function getByStockJournalEntryId(int $stockJournalEntryId): Collection;
}
