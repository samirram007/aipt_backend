<?php

namespace App\Modules\OrderJournal\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\OrderJournal\Models\OrderJournal;

interface OrderJournalServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?OrderJournal;
    public function store(array $data): OrderJournal;
    public function update(array $data, int $id): OrderJournal;
    public function delete(int $id): bool;
}
