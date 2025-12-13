<?php

namespace App\Modules\TransactionInstrument\Services;

use App\Modules\TransactionInstrument\Contracts\TransactionInstrumentServiceInterface;
use App\Modules\TransactionInstrument\Models\TransactionInstrument;
use Illuminate\Database\Eloquent\Collection;

class TransactionInstrumentService implements TransactionInstrumentServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return TransactionInstrument::with($this->resource)->get();
    }

    public function getById(int $id): ?TransactionInstrument
    {
        return TransactionInstrument::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TransactionInstrument
    {
        return TransactionInstrument::create($data);
    }

    public function update(array $data, int $id): TransactionInstrument
    {
        $record = TransactionInstrument::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TransactionInstrument::findOrFail($id);
        return $record->delete();
    }
}
