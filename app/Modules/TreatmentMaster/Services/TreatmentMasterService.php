<?php

namespace App\Modules\TreatmentMaster\Services;

use App\Modules\TreatmentMaster\Contracts\TreatmentMasterServiceInterface;
use App\Modules\TreatmentMaster\Models\TreatmentMaster;
use Illuminate\Database\Eloquent\Collection;

class TreatmentMasterService implements TreatmentMasterServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return TreatmentMaster::with($this->resource)->get();
    }

    public function getById(int $id): ?TreatmentMaster
    {
        return TreatmentMaster::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TreatmentMaster
    {
        return TreatmentMaster::create($data);
    }

    public function update(array $data, int $id): TreatmentMaster
    {
        $record = TreatmentMaster::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TreatmentMaster::findOrFail($id);
        return $record->delete();
    }
}
