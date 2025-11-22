<?php

namespace App\Modules\FiscalYear\Services;

use App\Modules\FiscalYear\Contracts\FiscalYearServiceInterface;
use App\Modules\FiscalYear\Models\FiscalYear;
use Illuminate\Database\Eloquent\Collection;

class FiscalYearService implements FiscalYearServiceInterface
{
    protected $resource = ['company'];

    public function getAll(): Collection
    {
        // dd(FiscalYear::with($this->resource)->get());
        return FiscalYear::with($this->resource)->get();
    }

    public function getById(int $id): ?FiscalYear
    {
        return FiscalYear::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): FiscalYear
    {
        //dd($data);
        // $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
        // $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
        return FiscalYear::create($data);
    }

    public function update(array $data, int $id): FiscalYear
    {
        // dd($data);
        $record = FiscalYear::findOrFail($id);
        $record->update($data);
        $record->fresh();
        return $record->load($this->resource);
    }

    public function delete(int $id): bool
    {
        $record = FiscalYear::findOrFail($id);

        return $record->delete();
    }
}
