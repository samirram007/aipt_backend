<?php

namespace App\Modules\TestCancellationRequest\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;

interface TestCancellationRequestServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?TestCancellationRequest;
    public function store(array $data): TestCancellationRequest;
    public function update(array $data, int $id): TestCancellationRequest;
    public function delete(int $id): bool;
}
