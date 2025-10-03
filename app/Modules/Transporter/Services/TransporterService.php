<?php

namespace App\Modules\Transporter\Services;

use App\Modules\Transporter\Contracts\TransporterServiceInterface;
use App\Modules\Transporter\Models\Transporter;
use Illuminate\Database\Eloquent\Collection;

class TransporterService implements TransporterServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Transporter::with($this->resource)->get();
    }

    public function getById(int $id): ?Transporter
    {
        return Transporter::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Transporter
    {
        return Transporter::create($data);
    }

    public function update(array $data, int $id): Transporter
    {
        $record = Transporter::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Transporter::findOrFail($id);
        return $record->delete();
    }
}
