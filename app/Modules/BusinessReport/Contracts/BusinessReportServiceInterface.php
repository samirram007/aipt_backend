<?php

namespace App\Modules\BusinessReport\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\BusinessReport\Models\BusinessReport;
use Illuminate\Http\JsonResponse;

interface BusinessReportServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): ?BusinessReport;
    public function store(array $data): BusinessReport;
    public function update(array $data, int $id): BusinessReport;
    public function delete(int $id): bool;

    // business reports
    public function test_summary(string $start_date, string $end_date, ?int $departmentId = null): JsonResponse;
}
