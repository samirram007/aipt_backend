<?php

namespace App\Modules\StockJournalBatchEntry\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournalBatchEntry\Models\StockJournalBatchEntry;

interface StockJournalBatchEntryServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournalBatchEntry;
    public function store(array $data): StockJournalBatchEntry;
    public function update(array $data, int $id): StockJournalBatchEntry;
    public function delete(int $id): bool;
}
