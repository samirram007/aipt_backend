<?php

namespace App\Modules\CompanyType\Services;

use App\Modules\CompanyType\Contracts\CompanyTypeServiceInterface;
use App\Modules\CompanyType\Models\CompanyType;
use Illuminate\Database\Eloquent\Collection;

class CompanyTypeService implements CompanyTypeServiceInterface
{
    protected $resource=['companies'];
    public function getAll(): Collection
    {
        return CompanyType::with($this->resource)->get();
    }

    public function getById(int $id): CompanyType
    {
        return CompanyType::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): CompanyType
    {
        return CompanyType::create($data);
    }

    public function update(array $data, int $id): CompanyType
    {
        $record = CompanyType::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = CompanyType::findOrFail($id);
        return $record->delete();
    }
}
