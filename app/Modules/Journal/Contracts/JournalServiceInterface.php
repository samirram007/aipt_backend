<?php

namespace App\Modules\Journal\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\Journal\Models\Journal;

interface JournalServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Journal;
    public function store(array $data): Journal;
    public function update(array $data, int $id): Journal;
    public function delete(int $id): bool;
}
