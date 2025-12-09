<?php

namespace App\Modules\TestCancellationRequest\Services;

use App\Modules\TestCancellationRequest\Contracts\TestCancellationRequestServiceInterface;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TestCancellationRequestService implements TestCancellationRequestServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return TestCancellationRequest::with($this->resource)->get();
    }

    public function getById(int $id): ?TestCancellationRequest
    {
        return TestCancellationRequest::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestCancellationRequest
    {
        return TestCancellationRequest::create([
            'stock_journal_entry_id' => $data['stock_journal_entry_id'],
            'status' => $data['status'],
            'remarks' => $data['remarks'],
            'requested_by' => Auth::id()
        ]);
    }

    public function update(array $data, int $id): TestCancellationRequest
    {
        $record = TestCancellationRequest::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestCancellationRequest::findOrFail($id);
        return $record->delete();
    }
}
