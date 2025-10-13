<?php

namespace App\Modules\Doctor\Services;

use App\Modules\Doctor\Contracts\DoctorServiceInterface;
use App\Modules\Doctor\Models\Doctor;
use Illuminate\Database\Eloquent\Collection;

class DoctorService implements DoctorServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Doctor::with($this->resource)->get();
    }

    public function getById(int $id): ?Doctor
    {
        return Doctor::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Doctor
    {
        return Doctor::create($data);
    }

    public function update(array $data, int $id): Doctor
    {
        $record = Doctor::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Doctor::findOrFail($id);
        return $record->delete();
    }
}
