<?php

namespace App\Modules\BusinessReport\Services;

use App\Modules\BusinessReport\Contracts\BusinessReportServiceInterface;
use App\Modules\BusinessReport\Models\BusinessReport;
use Illuminate\Database\Eloquent\Collection;

class BusinessReportService implements BusinessReportServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return BusinessReport::with($this->resource)->get();
    }

    public function getById(int $id): ?BusinessReport
    {
        return BusinessReport::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): BusinessReport
    {
        return BusinessReport::create($data);
    }

    public function update(array $data, int $id): BusinessReport
    {
        $record = BusinessReport::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = BusinessReport::findOrFail($id);
        return $record->delete();
    }

    public function test_summary(string $start_date, string $end_date, int $departmentId): Collection
    {
        return BusinessReport::all();
    }
}
