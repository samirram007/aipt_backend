<?php

namespace App\Modules\Holiday\Services;

use App\Modules\Holiday\Contracts\HolidayServiceInterface;
use App\Modules\Holiday\Models\Holiday;
use Illuminate\Database\Eloquent\Collection;

class HolidayService implements HolidayServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return Holiday::with($this->resource)->get();
    }

    public function getById(int $id): ?Holiday
    {
        return Holiday::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Holiday
    {
        return Holiday::create($data);
    }

    public function update(array $data, int $id): Holiday
    {
        $record = Holiday::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Holiday::findOrFail($id);
        return $record->delete();
    }
}
