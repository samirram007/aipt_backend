<?php

namespace App\Modules\AccountsJournal\Services;

use App\Modules\AccountsJournal\Contracts\AccountsJournalServiceInterface;
use App\Modules\AccountsJournal\Models\AccountsJournal;
use Illuminate\Database\Eloquent\Collection;

class AccountsJournalService implements AccountsJournalServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return AccountsJournal::with($this->resource)->get();
    }

    public function getById(int $id): ?AccountsJournal
    {
        return AccountsJournal::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): AccountsJournal
    {
        return AccountsJournal::create($data);
    }

    public function update(array $data, int $id): AccountsJournal
    {
        $record = AccountsJournal::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = AccountsJournal::findOrFail($id);
        return $record->delete();
    }
}
