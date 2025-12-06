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


            $dispatchDetailData = [
                'voucher_id' => $deliverNoteId,
                'distance' => $data['distance'] ?? null,
                'rate' => $data['rate'] ?? null,
                'distance_unit_id' => $data['distance_unit_id'] ?? null,
                'rate_unit_id' => $data['rate_unit_id'] ?? null,
                'quantity' => $data['quantity'] ?? null,
                'weight' => $data['weight'] ?? null,
                'volume' => $data['volume'] ?? null,
                'loading_charges' => $data['loading_charges'] ?? null,
                'unloading_charges' => $data['unloading_charges'] ?? null,
                'packing_charges' => $data['packing_charges'] ?? null,
                'insurance_charges' => $data['insurance_charges'] ?? null,
                'other_charges' => $data['other_charges'] ?? null,
                'freight_charges' => $data['freight_charges'] ?? null,
                'total_fare' => $data['total_fare'] ?? null,
            ];
            $dispatchDetail = $deliveryNote->voucher_dispatch_detail;
            $rules = (new VoucherDispatchDetailRequest())->rules();
            // dump($rules);
            $validatedDispatchData = Validator::make($dispatchDetailData, $rules)->validate();

            //  dd($validatedDispatchData);
            if (!empty($validatedDispatchData)) {
                if (!$dispatchDetail) {

                    $dispatchDetail = $this->voucherDispatchDetailService->store($validatedDispatchData);
                    //dd("VoucherLevel", $stockJournal);
                    $data['stock_journal_id'] = $stockJournal->id ?? null;

                } else {
                    $dispatchDetail = $this->voucherDispatchDetailService->update($validatedDispatchData, $dispatchDetail->id);
                }
            }



            $deliverNoteAsReferences = $this->voucherReferenceService->getByReferenceVoucherId($deliverNoteId);


            $existingFreightReference = $deliverNoteAsReferences->first(function ($reference) {
                $refVoucher = $this->voucherService->getById($reference->voucher_id);
                return $refVoucher && $refVoucher->module === 'freight'
                    && $refVoucher->voucher_type_id === $this->salesVoucherTypeID;
            });

            if ($existingFreightReference) {
                $salesVoucher = $this->voucherService->getById($existingFreightReference->voucher_id);
                return $salesVoucher->load('company');
                //throw new \Exception("A Freight record is already associated with this Delivery Note ID: " . $deliverNoteId);
            } else {


                // Create a new Sales Voucher linked to this Delivery Note
                $salesAccountLedger = $this->accountLedgerService->getById($this->salesAccountLedgerID);
                if (!$salesAccountLedger) {
                    throw new \Exception("Sales Account Ledger not found with ID: " . $this->salesAccountLedgerID);
                }
                //  dd($deliveryNote->party_ledger['id']);

                //being the payment received towards freight charges pertaining to Delivery Note ID 24
                $salesVoucherData = [
                    'voucher_type_id' => $this->salesVoucherTypeID,
                    'voucher_date' => date('Y-m-d'),
                    'company_id' => $deliveryNote->company_id,
                    'fiscal_year_id' => $deliveryNote->fiscal_year_id,
                    'module' => 'freight',
                    'reference_no' => $deliveryNote->voucher_no,
                    'reference_date' => $deliveryNote->voucher_date,
                    'remarks' => 'being the payment received towards freight charges pertaining to Delivery Note ID : ' . $deliverNoteId . ' dated ' . $deliveryNote->voucher_date,
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
                            'credit' => $data['total_fare'] ?? 0,
                        ],
                        [
                            'entry_order' => 2,
                            'account_ledger_id' => $deliveryNote->party_ledger['id'],
                            'debit' => $data['total_fare'] ?? 0,
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
                $salesVoucherStored = $this->voucherService->store($validatedVoucherData);
                $salesVoucher = $this->voucherService->getById($salesVoucherStored->id);
                return $salesVoucher->load('company');


            }

        }
        throw new \Exception("Delivery Note ID is required to create Freight record.");
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
