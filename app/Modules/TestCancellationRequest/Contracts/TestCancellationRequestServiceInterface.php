<?php

namespace App\Modules\TestCancellationRequest\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;
use Illuminate\Http\JsonResponse;

interface TestCancellationRequestServiceInterface
{
    public function getAll(): JsonResponse;
    public function getById(int $id): ?TestCancellationRequest;
    public function getByBookingNo(string $bookingNo): JsonResponse;
    public function store(array $data): TestCancellationRequest;
    public function update(array $data, int $id): TestCancellationRequest;
    public function delete(int $id): bool;
}
