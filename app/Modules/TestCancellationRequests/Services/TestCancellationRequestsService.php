<?php

namespace App\Modules\TestCancellationRequests\Services;

use App\Modules\TestCancellationRequests\Contracts\TestCancellationRequestsServiceInterface;
use App\Modules\TestCancellationRequests\Models\TestCancellationRequests;
use Illuminate\Database\Eloquent\Collection;

class TestCancellationRequestsService implements TestCancellationRequestsServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return TestCancellationRequests::with($this->resource)->get();
    }

    public function getById(int $id): ?TestCancellationRequests
    {
        return TestCancellationRequests::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestCancellationRequests
    {
        return TestCancellationRequests::create($data);
    }

    public function update(array $data, int $id): TestCancellationRequests
    {
        $record = TestCancellationRequests::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestCancellationRequests::findOrFail($id);
        return $record->delete();
    }
}
