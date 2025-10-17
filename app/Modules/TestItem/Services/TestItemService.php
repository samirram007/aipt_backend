<?php

namespace App\Modules\TestItem\Services;

use App\Modules\TestItem\Contracts\TestItemServiceInterface;
use App\Modules\TestItem\Models\TestItem;
use Illuminate\Database\Eloquent\Collection;

class TestItemService implements TestItemServiceInterface
{
    protected $resource = ['stock_unit', 'alternate_stock_unit','stock_category','test_item_report_templates.doctor'];

    public function getAll(): Collection
    {
        return TestItem::with($this->resource)->get();
    }

    public function getById(int $id): ?TestItem
    {
        return TestItem::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestItem
    {
        return TestItem::create($data);
    }

    public function update(array $data, int $id): TestItem
    {
        $record = TestItem::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestItem::findOrFail($id);
        return $record->delete();
    }
}
