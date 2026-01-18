<?php

namespace App\Modules\StockJournal\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockJournal\Models\StockJournal;

interface StockJournalServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?StockJournal;
    public function store(array $data): StockJournal;
    public function update(array $data, int $id): StockJournal;
    public function delete(int $id): bool;
}