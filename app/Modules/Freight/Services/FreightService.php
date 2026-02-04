<?php

namespace App\Modules\Freight\Services;

use App\Modules\AccountLedger\Contracts\AccountLedgerServiceInterface;
use App\Modules\AccountLedger\Models\AccountLedger;
use App\Modules\AccountLedger\Services\AccountLedgerService;
use App\Modules\Freight\Contracts\FreightServiceInterface;
use App\Modules\Freight\Models\Freight;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\Voucher\Requests\VoucherRequest;
use App\Modules\VoucherDispatchDetail\Contracts\VoucherDispatchDetailServiceInterface;
use App\Modules\VoucherDispatchDetail\Requests\VoucherDispatchDetailRequest;
use App\Modules\VoucherDispatchDetail\Services\VoucherDispatchDetailService;
use App\Modules\VoucherReference\Contracts\VoucherReferenceServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class FreightService implements FreightServiceInterface
{
    protected $resource = [];
    protected $deliverNoteVoucherTypeID = 2001; //delivery note
    protected $salesVoucherTypeID = 1006; //sales voucher
    protected $receiptVoucherTypeID = 1003;
    protected $salesAccountLedgerID = 3000001; //sales account ledger id
    function __construct(
        protected AccountLedgerServiceInterface $accountLedgerService,
        protected VoucherServiceInterface $voucherService,
        protected VoucherReferenceServiceInterface $voucherReferenceService,
        protected VoucherDispatchDetailServiceInterface $voucherDispatchDetailService
    ) {
        $this->resource = [
            // Define any relationships to load with Freight model if needed
        ];
    }

    public function getAll(): Collection
    {
        $deliveryNotes = $this->voucherService->getByModule('freight');
        return Freight::with($this->resource)->get();
    }


    public function getDeliveryNote(): Collection
    {

        $deliveryNotes = $this->voucherService->getByVoucherType($this->deliverNoteVoucherTypeID);
        //dump($deliveryNotes->toArray());
        $deliveryNotesWithOutFreight = $deliveryNotes->filter(function ($voucher) {
            $allReference = $this->voucherReferenceService->getByVoucherId($voucher->id);
            //if exists the reference voucher must have a moduleAttribute 'freight'
            $freightReference = $allReference->first(function ($reference) {
                $refVoucher = $this->voucherService->getById($reference->ref_voucher_id);
                return $refVoucher && $refVoucher->module === 'freight'
                    && $refVoucher->voucher_type_id === $this->salesVoucherTypeID;
            });
            //dump($freightReference);

            return is_null($freightReference);
        });
        //$deliveryNotesWithFreight = $deliveryNotes->diff($deliveryNotesWithOutFreight);
        //dd($deliveryNotesWithFreight->toArray());
        //dd($deliveryNotesWithFreight->toArray());
        return $deliveryNotesWithOutFreight;
    }


    public function godownWiseReport(): Collection
    {
        // Implement the logic for godown wise report
        // Return a collection of results
        return collect(); // Placeholder
    }
    public function transporterWiseReport(): Collection
    {
        // Implement the logic for transporter wise report
        // Return a collection of results
        return collect(); // Placeholder
    }
    public function vehicleWiseReport(): Collection
    {
        // Implement the logic for vehicle wise report
        // Return a collection of results
        return collect(); // Placeholder
    }
    public function billingPreferenceReport(): Collection
    {
        // Implement the logic for billing preference report
        // Return a collection of results
        return collect(); // Placeholder
    }


    public function voucherWiseReport(): Collection
    {
        $vouchers = Voucher::with($this->resource)
            ->where('vouchers.module', 'freight')

            ->leftJoin('voucher_references', 'voucher_references.voucher_id', '=', 'vouchers.id')
            ->leftJoin('vouchers as ref_voucher', 'ref_voucher.id', '=', 'voucher_references.ref_voucher_id')

            ->join('user_fiscal_years', 'vouchers.fiscal_year_id', '=', 'user_fiscal_years.fiscal_year_id')
            ->whereColumn('vouchers.voucher_date', '>=', 'user_fiscal_years.start_date')
            ->whereColumn('vouchers.voucher_date', '<=', 'user_fiscal_years.end_date')

            ->orderBy('vouchers.created_at', 'desc')
            ->select(
                'vouchers.*',
                'ref_voucher.voucher_no as referenced_voucher_no',
                'voucher_references.type as reference_type'
            )
            ->get();

        return $vouchers->map(fn($voucher) => $this->attachLedgerInfo($voucher));
    }

    protected function attachLedgerInfo(Voucher $voucher): Voucher
    {
        // dd($voucher);
        // Detect party ledger (Customer / Supplier)
        // dd($voucher->voucher_entries->first());
        $partyEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->ledgerable_type, ['customer', 'supplier', 'distributor']));
        //dd($partyEntry);
        // Detect transaction ledger using account_group_id
        $purchaseGroupId = 40001; // Purchase group ID
        $salesGroupId = 50001;    // Sales group ID
        $stockGroupId = 10009;    // Stock group ID

        $transactionEntry = $voucher->voucher_entries
            ->first(fn($entry) => in_array($entry->account_ledger->account_group_id, [$purchaseGroupId, $salesGroupId, $stockGroupId]));

        // Calculate current balance for party ledger
        $partyCurrentBalance = $partyEntry?->account_ledger
            ? $partyEntry->account_ledger->voucher_entries()->sum('debit') - $partyEntry->account_ledger->voucher_entries()->sum('credit')
            : 0;
        // dd($partyCurrentBalance);
        // Calculate current balance for transaction ledger
        $transactionCurrentBalance = $transactionEntry?->account_ledger
            ? $transactionEntry->account_ledger->voucher_entries()->sum('debit') -
            $transactionEntry->account_ledger->voucher_entries()->sum('credit')
            : 0;
        // dd($transactionEntry->account_ledger->voucher_entries()->sum('credit'));
        // Attach full ledger objects with current balance


        $voucher->setRelation(
            'party_ledger',
            $partyEntry?->account_ledger
                ? array_merge(
                    $partyEntry->account_ledger->only(['id', 'name', 'code', 'ledgerable_type', 'ledgerable_id']),
                    ['current_balance' => $partyCurrentBalance]
                )
                : null
        );

        $voucher->setRelation(
            'transaction_ledger',
            $transactionEntry?->account_ledger
                ? array_merge(
                    $transactionEntry->account_ledger->only(['id', 'name', 'code', 'account_group_id']),
                    ['current_balance' => $transactionCurrentBalance]
                )
                : null
        );
        // $voucher->transaction_ledger['current_balance'] = $transactionCurrentBalance;
        // dd($voucher);
        // Attach voucher amount (total debit or credit)
        $voucher->amount = $voucher->voucher_entries->sum(fn($entry) => $entry->debit ?: $entry->credit ?: 0);

        return $voucher;
    }


    public function getById(int $id): ?Freight
    {
        return Freight::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): Voucher
    {

        $deliverNoteId = $data['delivery_note_id'] ?? null;
        if ($deliverNoteId) {
            $deliveryNote = $this->voucherService->getById($deliverNoteId);
            if (!$deliveryNote) {
                throw new \Exception("Delivery Note not found with ID: " . $deliverNoteId);
            }


            // $dispatchDetailData = [
            //     'voucher_id' => $deliverNoteId,
            //     'distance' => $data['distance'] ?? null,
            //     'rate' => $data['rate'] ?? null,
            //     'distance_unit_id' => $data['distance_unit_id'] ?? null,
            //     'rate_unit_id' => $data['rate_unit_id'] ?? null,
            //     'quantity' => $data['quantity'] ?? null,
            //     'weight' => $data['weight'] ?? null,
            //     'weight_unit_id' => $data['weight_unit_id'] ?? null,
            //     'volume' => $data['volume'] ?? null,
            //     'volume_unit_id' => $data['volume_unit_id'] ?? null,
            //     'loading_charges' => $data['loading_charges'] ?? null,
            //     'unloading_charges' => $data['unloading_charges'] ?? null,
            //     'packing_charges' => $data['packing_charges'] ?? null,
            //     'insurance_charges' => $data['insurance_charges'] ?? null,
            //     'other_charges' => $data['other_charges'] ?? null,
            //     'freight_charges' => $data['freight_charges'] ?? null,
            //     'total_fare' => $data['total_fare'] ?? null,
            // ];
            $dispatchDetail = $deliveryNote->voucher_dispatch_detail;
            // $rules = (new VoucherDispatchDetailRequest())->rules();
            // // dump($rules);
            // $validatedDispatchData = Validator::make($dispatchDetailData, $rules)->validate();

            // //  dd($validatedDispatchData);
            // if (!empty($validatedDispatchData)) {
            //     if (!$dispatchDetail) {

            //         $dispatchDetail = $this->voucherDispatchDetailService->store($validatedDispatchData);
            //         //dd("VoucherLevel", $stockJournal);
            //         $data['stock_journal_id'] = $stockJournal->id ?? null;

            //     } else {
            //         $dispatchDetail = $this->voucherDispatchDetailService->update($validatedDispatchData, $dispatchDetail->id);
            //     }
            // }



            $deliverNoteAsReferences = $this->voucherReferenceService->getByReferenceVoucherId($deliverNoteId);


            $existingFreightReference = $deliverNoteAsReferences->first(function ($reference) {
                $refVoucher = $this->voucherService->getById($reference->voucher_id);
                return $refVoucher && $refVoucher->module === 'freight'
                    && $refVoucher->voucher_type_id === $this->salesVoucherTypeID;
            });

            if ($existingFreightReference) {
                $salesVoucher = $this->voucherService->getById($existingFreightReference->voucher_id);
                if ($salesVoucher->amount == $dispatchDetail->total_fare) {
                    return $salesVoucher->load('company');
                }

                $salesVoucher->voucher_entries->each(function ($entry) {
                    $entry->delete();
                });
                $salesVoucher->voucher_references->each(function ($reference) {
                    $reference->delete();
                });
                $salesVoucher->delete();
                // return $salesVoucher->load('company');
                //throw new \Exception("A Freight record is already associated with this Delivery Note ID: " . $deliverNoteId);
            }


            // Create a new Sales Voucher linked to this Delivery Note
            $salesAccountLedger = $this->accountLedgerService->getById($this->salesAccountLedgerID);
            if (!$salesAccountLedger) {
                throw new \Exception("Sales Account Ledger not found with ID: " . $this->salesAccountLedgerID);
            }


            //being the payment received towards freight charges pertaining to Delivery Note ID 24
            $salesVoucherData = [
                'voucher_type_id' => $this->salesVoucherTypeID,
                'voucher_date' => date('Y-m-d'),
                'company_id' => $deliveryNote->company_id,
                'fiscal_year_id' => $deliveryNote->fiscal_year_id,
                'module' => 'freight',
                'reference_no' => $deliveryNote->voucher_no,
                'reference_date' => $deliveryNote->voucher_date,
                'remarks' => 'being the payment received towards freight charges pertaining to Delivery Note ID : ' . $deliverNoteId . ' dated ' . date_format($deliveryNote->voucher_date, 'd-M-Y'),
                'party_ledger' => $deliveryNote->party_ledger,
                'transaction_ledger' => [
                    'id' => $salesAccountLedger->id,
                    'name' => $salesAccountLedger->name,
                    'code' => $salesAccountLedger->code,
                    'account_group_id' => $salesAccountLedger->account_group_id,

                ],
                'voucher_entries' => [
                    [
                        'entry_order' => 1,
                        'account_ledger_id' => $salesAccountLedger->id,
                        'debit' => 0,
                        'credit' => $dispatchDetail->total_fare ?? 0,
                    ],
                    [
                        'entry_order' => 2,
                        'account_ledger_id' => $deliveryNote->party_ledger['id'],
                        'debit' => $dispatchDetail->total_fare ?? 0,
                        'credit' => 0,
                    ],
                ],
                'voucher_reference' => [
                    'ref_voucher_id' => $deliverNoteId,
                    'type' => 'freight'
                ],
                // Add other necessary fields here
            ];
            $voucherRules = (new VoucherRequest())->rules();
            // dump($rules);
            $validatedVoucherData = Validator::make($salesVoucherData, $voucherRules)->validate();
            // dd($validatedVoucherData);
            //check if

            $salesVoucherStored = $this->voucherService->store($validatedVoucherData);
            $salesVoucher = $this->voucherService->getById($salesVoucherStored->id);
            return $salesVoucher->load('company');
        }
        throw new \Exception("Delivery Note ID is required to create Freight record.");
    }

    public function payment_voucher(array $data): Collection
    {
        $deliverNoteId = $data['delivery_note_id'] ?? null;
        if ($deliverNoteId) {
            $deliveryNote = $this->voucherService->getById($deliverNoteId);
            if (!$deliveryNote) {
                throw new \Exception("Delivery Note not found with ID: " . $deliverNoteId);
            }
        }

        $receiptVoucherData = [
            'voucher_type_id' => $this->receiptVoucherTypeID,
        ];
    }

    public function update(array $data, int $id): Freight
    {
        $record = Freight::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = Freight::findOrFail($id);
        return $record->delete();
    }
}
