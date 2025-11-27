<?php

namespace App\Modules\StockJournalReference\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournalReference\Models\StockJournalReference;

interface StockJournalReferenceServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournalReference;
    public function store(array $data): StockJournalReference;
    public function update(array $data, int $id): StockJournalReference;
    public function delete(int $id): bool;
}
