<?php

namespace App\Modules\Patient\Services;

use App\Modules\Patient\Contracts\PatientServiceInterface;
use App\Modules\Patient\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

class PatientService implements PatientServiceInterface
{
    protected $resource=['agent','physician','address'];

    public function getAll(): Collection
    {
        return Patient::with($this->resource)->get();
    }

    public function getById(int $id): ?Patient
    {
        return Patient::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Patient
    {
        $address = $data['address'];
        unset($data['address']);
        $patient = Patient::create($data);
        if($address){
            $address['addressable_id'] = $patient->id;
            $address['addressable_type'] = 'patient';
            $patient->addresses()->create($address);
        }
        return $patient->load($this->resource);
    }

    public function update(array $data, int $id): Patient
    {
        $record = Patient::findOrFail($id);

        if(isset($data['address'])){
            $addressData = $data['address'];
            unset($data['address']);
            if($record->address){
                $record->address()->update($addressData);
            }else{
                $addressData['addressable_id'] = $record->id;
                $addressData['addressable_type'] = 'patient';
                $record->address()->create($addressData);
            }
        }
        $record->update($data);
        return $record->fresh()->load($this->resource);
    }

    public function delete(int $id): bool
    {
        $record = Patient::findOrFail($id);
        return $record->delete();
    }
}
