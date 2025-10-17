<?php

namespace App\Modules\TestItemReportTemplate\Services;

use App\Modules\TestItemReportTemplate\Contracts\TestItemReportTemplateServiceInterface;
use App\Modules\TestItemReportTemplate\Models\TestItemReportTemplate;
use Illuminate\Database\Eloquent\Collection;

class TestItemReportTemplateService implements TestItemReportTemplateServiceInterface
{
    protected $resource=['doctor','test_item'];

    public function getAll(): Collection
    {
        return TestItemReportTemplate::with($this->resource)->get();
    }

    public function getById(int $id): Collection
    {
         return TestItemReportTemplate::with($this->resource)
        ->where('test_item_id', $id)
        ->get();
    }

    public function getByTestId(int $id): Collection
    {
           return TestItemReportTemplate::with($this->resource)
        ->where('test_item_id', $id)
        ->get();
    }

    public function store(array $data): TestItemReportTemplate
    {
        $result = TestItemReportTemplate::create($data);
        return $result->load($this->resource);
    }

    public function update(array $data, int $id): TestItemReportTemplate
    {
        $record = TestItemReportTemplate::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestItemReportTemplate::findOrFail($id);
        return $record->delete();
    }
}
