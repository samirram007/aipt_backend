<?php

namespace App\Modules\StockJournalEntry\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;

interface StockJournalEntryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournalEntry;
    public function store(array $data): StockJournalEntry;
    public function update(array $data, int $id): StockJournalEntry;
    public function delete(int $id): bool;
    public function getByStockJournalId(int $stockJournalId): Collection;
}
