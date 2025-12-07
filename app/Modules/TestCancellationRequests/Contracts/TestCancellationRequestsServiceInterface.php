<?php

namespace App\Modules\TestCancellationRequests\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TestCancellationRequests\Models\TestCancellationRequests;

interface TestCancellationRequestsServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?TestCancellationRequests;
    public function store(array $data): TestCancellationRequests;
    public function update(array $data, int $id): TestCancellationRequests;
    public function delete(int $id): bool;
}
