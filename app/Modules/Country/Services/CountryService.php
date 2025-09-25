<?php

namespace App\Modules\Country\Services;

use App\Modules\Country\Contracts\CountryServiceInterface;
use App\Modules\Country\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class CountryService implements CountryServiceInterface
{
    protected $resource = ['states'];

    public function getAll(): Collection
    {
        return Country::with($this->resource)->get();
    }

    public function getById(int $id): ?Country
    {
        return Country::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Country
    {
        return Country::create($data);
    }

    public function update(array $data, int $id): Country
    {
        $record = Country::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Country::findOrFail($id);
        return $record->delete();
    }
}
