<?php

namespace App\Modules\Patient\Services;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Patient\Contracts\PatientServiceInterface;
use App\Modules\Patient\Models\Patient;
use Illuminate\Database\Eloquent\Collection;

class PatientService implements PatientServiceInterface
{
    protected $resource=['agent','physician','address','discount_type'];

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

        $data['account_group_id'] = 10001;
        if (isset($data['account_group_id'])) {

            $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($patient->name, $patient->id);
            $data['account_ledger']['code'] = $data['account_ledger']['name'];
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'patient';
            $data['account_ledger']['ledgerable_id'] = $patient->id;
            $patient->account_ledger()->create($data['account_ledger']);
        }

        return $patient->load($this->resource);
    }


    private function verifyUniqueLedgerName(string $name, ?int $id = null): string
    {
        if (empty(trim($name))) {
            throw new \InvalidArgumentException('Ledger name cannot be empty.');
        }

        // Normalize the name
        $baseName = trim($name);
        $uniqueName = $baseName;
        $counter = 1;
        //dd(AccountLedger::ledgerNameExists($uniqueName));
        // Check for uniqueness
        while (AccountLedger::ledgerNameExists($uniqueName)) {
            // dd($uniqueName);
            $uniqueName = sprintf('%s-%04d', $baseName, $counter);
            $counter++;
        }

        return $uniqueName;

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
