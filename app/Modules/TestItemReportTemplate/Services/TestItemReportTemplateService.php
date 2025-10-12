<?php

namespace App\Modules\TestItemReportTemplate\Services;

use App\Modules\TestItemReportTemplate\Contracts\TestItemReportTemplateServiceInterface;
use App\Modules\TestItemReportTemplate\Models\TestItemReportTemplate;
use Illuminate\Database\Eloquent\Collection;

class TestItemReportTemplateService implements TestItemReportTemplateServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return TestItemReportTemplate::with($this->resource)->get();
    }

    public function getById(int $id): ?TestItemReportTemplate
    {
        return TestItemReportTemplate::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestItemReportTemplate
    {
        return TestItemReportTemplate::create($data);
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
