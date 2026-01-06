<?php

namespace App\Modules\PatientSession\Services;

use App\Modules\PatientSession\Contracts\PatientSessionServiceInterface;
use App\Modules\PatientSession\Models\PatientSession;
use Illuminate\Database\Eloquent\Collection;

class PatientSessionService implements PatientSessionServiceInterface
{
    protected $resource=['patient','doctor'];

    public function getAll(): Collection
    {
        return PatientSession::with($this->resource)->get();
    }

    public function getById(int $id): ?PatientSession
    {
        return PatientSession::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): PatientSession
    {
        return PatientSession::create($data);
    }

    public function update(array $data, int $id): PatientSession
    {
        $record = PatientSession::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = PatientSession::findOrFail($id);
        return $record->delete();
    }
}