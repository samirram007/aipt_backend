<?php

namespace App\Modules\TestItemReportTemplate\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\TestItemReportTemplate\Models\TestItemReportTemplate;

interface TestItemReportTemplateServiceInterface
{
    public function getAll(): Collection;
    public function getById(int $id): Collection;
    public function getByTestId(int $id): Collection;
    public function store(array $data): TestItemReportTemplate;
    public function update(array $data, int $id): TestItemReportTemplate;
    public function delete(int $id): bool;
}
