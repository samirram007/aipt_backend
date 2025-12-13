<?php

namespace App\Modules\TransactionInstrument\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TransactionInstrument\Models\TransactionInstrument;

interface TransactionInstrumentServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?TransactionInstrument;
    public function store(array $data): TransactionInstrument;
    public function update(array $data, int $id): TransactionInstrument;
    public function delete(int $id): bool;
}
