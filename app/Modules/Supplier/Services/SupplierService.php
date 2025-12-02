<?php

namespace App\Modules\Supplier\Services;

use App\Enums\AddressType;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\Supplier\Contracts\SupplierServiceInterface;
use App\Modules\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class SupplierService implements SupplierServiceInterface
{
    protected $resource = ['account_ledger', 'address'];

    public function getAll(): Collection
    {
        return Supplier::with($this->resource)->get();
    }

    public function getById(int $id): ?Supplier
    {
        return Supplier::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Supplier
    {
        $clean = Arr::except($data, ['account_group_id', 'address', 'account_ledger', 'is_edit']);
        $supplier = Supplier::create($clean);

        if ($data['address']) {

            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'supplier';
            $data['address']['addressable_id'] = $supplier->id;
            //dump($data['address']);
            $supplier->address()->create($data['address']);
            // dd($data['address']);
        }
        if ($data['account_group_id']) {

            $data['account_ledger']['name'] = $supplier->name;
            $data['account_ledger']['code'] = $supplier->name;
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'supplier';
            $data['account_ledger']['ledgerable_id'] = $supplier->id;
            //dump($data['address']);
            $supplier->account_ledger()->create($data['account_ledger']);
            // dd($data['address']);
        }

        // 'ledgerable_id',
        // 'ledgerable_type'
        return $supplier->load($this->resource);
    }

    public function update(array $data, int $id): Supplier
    {
        $supplier = Supplier::findOrFail($id);
        $previousName = $supplier->name;
        $supplier->update($data);

        if (isset($data['address'])) {

            $data['address']['address_type'] = 'office';
            $data['address']['addressable_type'] = 'supplier';
            $data['address']['addressable_id'] = $supplier->id;
            if (!empty($data['address']['id'])) {
                $address = $supplier->address()->find($data['address']['id']);
                $address?->update($data['address']);
            } else {
                $supplier->address()->create($data['address']);
            }
        }
        $isDirty = $previousName != $data['name'] ? true : false;

        if (isset($data['account_group_id'])) {
            $accountLedger = AccountLedger::where('ledgerable_id', $supplier->id)->first();

            if ($isDirty) {
                $data['account_ledger']['name'] = $this->verifyUniqueLedgerName($supplier->name, $supplier->id);
                $data['account_ledger']['code'] = $data['account_ledger']['name'];
            }
            $data['account_ledger']['account_group_id'] = $data['account_group_id'];
            $data['account_ledger']['ledgerable_type'] = 'supplier';
            $data['account_ledger']['ledgerable_id'] = $supplier->id;
            if ($accountLedger) {
                $accountLedger->update($data['account_ledger']);
            } else {

                $supplier->account_ledger()->create($data['account_ledger']);
            }

        }

        return $supplier->fresh()->load($this->resource);
    }

    public function delete(int $id): bool
    {
        $record = Supplier::findOrFail($id);
        return $record->delete();
    }
}
