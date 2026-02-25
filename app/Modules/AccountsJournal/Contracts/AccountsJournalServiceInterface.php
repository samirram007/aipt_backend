<?php

namespace App\Modules\AccountsJournal\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\AccountsJournal\Models\AccountsJournal;

interface AccountsJournalServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?AccountsJournal;
    public function store(array $data): AccountsJournal;
    public function update(array $data, int $id): AccountsJournal;
    public function delete(int $id): bool;
}
