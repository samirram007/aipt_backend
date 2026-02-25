<?php

namespace App\Modules\Distributor\Services;

use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Distributor\Contracts\DistributorServiceInterface;
use App\Modules\Distributor\Models\Distributor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class DistributorService implements DistributorServiceInterface
{
    protected $resource = ['account_ledger', 'address'];

    public function getAll(): Collection
    {
        return Distributor::with($this->resource)->get();
    }

    public function getById(int $id): ?Distributor
    {
        return Distributor::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Distributor
    {
        //dump($data);
        $clean = Arr::except($data, ['account_group_id', 'address', 'account_ledger', 'is_edit']);
        $distributor = Distributor::create($clean);

        if ($data['address']) {

            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'distributor';
            $data['address']['addressable_id'] = $distributor->id;

            $distributor->address()->create($data['address']);
        }
        if ($data['account_group_id']) {

            $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($distributor->name, $distributor->id);
            $data['account_ledger']['code'] = $distributor->code ?? $data['account_ledger']['name'];
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'distributor';
            $data['account_ledger']['ledgerable_id'] = $distributor->id;
            $distributor->account_ledger()->create($data['account_ledger']);

        }

        return $distributor->load($this->resource);
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


    public function update(array $data, int $id): Distributor
    {

        $distributor = Distributor::findOrFail($id);
        $previousName = $distributor->name;
        $distributor->update($data);

        if (isset($data['address'])) {

            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'distributor';
            $data['address']['addressable_id'] = $distributor->id;
            if (!empty($data['address']['id'])) {
                $address = $distributor->address()->find($data['address']['id']);
                // dd($address);
                $address?->update($data['address']);
            } else {
                $distributor->address()->create($data['address']);
            }
        }
        $isDirty = $previousName != $data['name'] ? true : false;

        if (isset($data['account_group_id'])) {
            $accountLedger = AccountLedger::where('ledgerable_id', $distributor->id)->first();

            if ($isDirty) {
                $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($distributor->name, $distributor->id);
                $data['account_ledger']['code'] = $data['account_ledger']['name'];
            }
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'distributor';
            $data['account_ledger']['ledgerable_id'] = $distributor->id;
            if ($accountLedger) {
                $accountLedger->update($data['account_ledger']);
            } else {

                $distributor->account_ledger()->create($data['account_ledger']);
            }

        }

        return $distributor->fresh()->load($this->resource);
    }

    public function delete(int $id): bool
    {
        $record = Distributor::findOrFail($id);
        return $record->delete();
    }
}
