<?php

namespace App\Modules\Company\Services;

use App\Modules\Company\Contracts\CompanyServiceInterface;
use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService implements CompanyServiceInterface
{
    protected $resource = ['company_type', 'fiscal_years', 'state', 'country', 'currency'];

    public function getAll(): Collection
    {
        return Company::with($this->resource)->get();
    }

    public function getById(int $id): ?Company
    {

        return Company::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Company
    {
        return Company::create($data);
    }

    public function update(array $data, int $id): Company
    {
        $record = Company::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Company::findOrFail($id);
        return $record->delete();
    }
}
