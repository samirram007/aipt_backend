<?php

namespace App\Modules\Receipt\Services;

use App\Modules\Receipt\Contracts\ReceiptServiceInterface;
use App\Modules\Receipt\Models\Receipt;
use Illuminate\Database\Eloquent\Collection;

class ReceiptService implements ReceiptServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Receipt::with($this->resource)->get();
    }

    public function getById(int $id): ?Receipt
    {
        return Receipt::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Receipt
    {
        return Receipt::create($data);
    }

    public function update(array $data, int $id): Receipt
    {
        $record = Receipt::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Receipt::findOrFail($id);
        return $record->delete();
    }
}
