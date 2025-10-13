<?php

namespace App\Modules\Employee\Services;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Employee\Contracts\EmployeeServiceInterface;
use App\Modules\Employee\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService implements EmployeeServiceInterface
{
    protected $resource = ['department', 'designation', 'address'];

    public function getAll(): Collection
    {
        return Employee::with($this->resource)->get();
    }

    public function getById(int $id): ?Employee
    {
        return Employee::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Employee
    {
        if (empty($data['code'])) {
            $data['code'] = Employee::getUniqueCode();
        }
            $data['dob'] = isset($data['dob']) ? Carbon::parse($data['dob'])->toDateString() : null;
            $data['doj'] = isset($data['doj']) ? Carbon::parse($data['doj'])->toDateString() : null;
        $employee = Employee::create($data);

        if ($data['address']) {

            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'employee';
            $data['address']['addressable_id'] = $employee->id;

            $employee->address()->create($data['address']);
        }
        if ($data['account_group_id']) {

            $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($employee->name, $employee->id);
            $data['account_ledger']['code'] = $data['account_ledger']['name'];
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'employee';
            $data['account_ledger']['ledgerable_id'] = $employee->id;
            $employee->account_ledger()->create($data['account_ledger']);

        }

        return $employee->load($this->resource);
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


    public function update(array $data, int $id): Employee
    {

        if (empty($data['code'])) {
            $data['code'] = Employee::getUniqueCode();
        }
        $employee = Employee::findOrFail($id);
        $previousName = $employee->name;
        $employee->update($data);

        if (isset($data['address'])) {

            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'employee';
            $data['address']['addressable_id'] = $employee->id;
            if (!empty($data['address']['id'])) {
                $address = $employee->address()->find($data['address']['id']);
                // dd($address);
                $address?->update($data['address']);
            } else {
                $employee->address()->create($data['address']);
            }
        }
        $isDirty = $previousName != $data['name'] ? true : false;

        if (isset($data['account_group_id'])) {
            $accountLedger = AccountLedger::where('ledgerable_id', $employee->id)->first();

            if ($isDirty) {
                $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($employee->name, $employee->id);
                $data['account_ledger']['code'] = $data['account_ledger']['name'];
            }
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'employee';
            $data['account_ledger']['ledgerable_id'] = $employee->id;
            if ($accountLedger) {
                $accountLedger->update($data['account_ledger']);
            } else {

                $employee->account_ledger()->create($data['account_ledger']);
            }

        }

        return $employee->fresh()->load($this->resource);
    }

    public function delete(int $id): bool
    {
        $record = Employee::findOrFail($id);
        return $record->delete();
    }
}
