<?php

namespace App\Modules\Company\Services;

use App\Modules\Company\Contracts\CompanyServiceInterface;
use App\Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService implements CompanyServiceInterface
{
    protected $resource = ['company_type', 'address', 'fiscal_years', 'currency'];

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
        if (empty($data['mailing_name'])) {
            $data['mailing_name'] = $data['name'];
        }
        $company = Company::create($data);

        if (!empty($data['address'])) {

            $data['address']['address_type'] = 'company';
            $data['address']['addressable_type'] = 'company';
            $data['address']['addressable_id'] = $company->id;

            $company->address()->create($data['address']);
        }

        return $company->load($this->resource);
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
