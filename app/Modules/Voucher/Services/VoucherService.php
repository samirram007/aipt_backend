<?php

namespace App\Modules\Voucher\Services;

use App\Modules\StockJournal\Contracts\StockJournalServiceInterface;
use App\Modules\StockJournal\Requests\StockJournalRequest;
use App\Modules\StockJournal\Services\StockJournalService;
use App\Modules\Voucher\Contracts\VoucherServiceInterface;
use App\Modules\Voucher\Models\Voucher;
use App\Modules\VoucherDispatchDetail\Contracts\VoucherDispatchDetailServiceInterface;
use App\Modules\VoucherDispatchDetail\Requests\VoucherDispatchDetailRequest;
use App\Modules\VoucherEntry\Contracts\VoucherEntryServiceInterface;
use App\Modules\VoucherEntry\Requests\VoucherEntryRequest;
use App\Modules\VoucherNo\Contracts\VoucherNoServiceInterface;
use App\Modules\VoucherParty\Contracts\VoucherPartyServiceInterface;
use App\Modules\VoucherParty\Requests\VoucherPartyRequest;
use App\Modules\VoucherReference\Contracts\VoucherReferenceServiceInterface;
use App\Modules\VoucherReference\Requests\VoucherReferenceRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class VoucherService implements VoucherServiceInterface
{
    protected $resource = [
        'voucher_type',
        'voucher_entries.account_ledger',
        'stock_journal.stock_journal_entries.rate_unit',
        'stock_journal.stock_journal_entries.stock_item.stock_unit',
        'stock_journal.stock_journal_entries.stock_item.alternate_stock_unit',
        'stock_journal.stock_journal_entries.alternate_unit',
        'stock_journal.stock_journal_entries.stock_journal_godown_entries.godown',
        'voucher_party.state',
        'voucher_party.country',
        'voucher_dispatch_detail',
        'company',
        'fiscal_year',
    ];
    protected $voucherNoService;
    protected $stockJournalRequest;
    protected $stockJournalService;
    protected $voucherEntryService;
    protected $voucherDispatchDetailService;
    protected $voucherPartyService;


    public function __construct(
        VoucherNoServiceInterface $voucherNoService,
        StockJournalServiceInterface $stockJournalService,
        VoucherEntryServiceInterface $voucherEntryService,
        VoucherDispatchDetailServiceInterface $voucherDispatchDetailService,
        VoucherPartyServiceInterface $voucherPartyService
    ) {
        $this->voucherNoService = $voucherNoService;
        $this->stockJournalService = $stockJournalService;
        $this->voucherEntryService = $voucherEntryService;
        $this->voucherDispatchDetailService = $voucherDispatchDetailService;
        $this->voucherPartyService = $voucherPartyService;
    }

    public function getAll(): Collection
    {
        // return Voucher::with($this->resource)->get();
        // dd("here");
        $vouchers = Voucher::with($this->resource)->orderBy('created_at', 'desc')->get();
        // dd($vouchers);
        return $vouchers->map(fn($voucher) => $this->attachLedgerInfo($voucher));
    }
    public function getByModule(string $module): Collection
    {
        $vouchers = Voucher::with($this->resource)
            ->where('module', $module)
            ->orderByDesc('created_at')
            ->get();
        return $vouchers->map(fn($voucher) => $this->attachLedgerInfo($voucher));
    }
    public function getByVoucherType(int $voucherTypeId): Collection
    {
        $vouchers = Voucher::with($this->resource)
            ->where('voucher_type_id', $voucherTypeId)
            ->orderByDesc('created_at')
            ->get();
        return $vouchers->map(fn($voucher) => $this->attachLedgerInfo($voucher));
    }

    public function getById(int $id): ?Voucher
    {
        // return Voucher::with($this->resource)->findOrFail($id);
        $voucher = Voucher::with($this->resource)->findOrFail($id);

        return $this->attachLedgerInfo($voucher);
    }

    public function store(array $data): Voucher
    {
        DB::beginTransaction();
        try {
            //code...
            if (isset($data['stock_journal']) && !empty($data['stock_journal'])) {
                $stock_journal = $data['stock_journal'];
                $rules = (new StockJournalRequest())->rules();
                $validatedStockJournal = Validator::make($stock_journal, $rules)->validate();
                if (!empty($validatedStockJournal)) {
                    $stockJournal = $this->stockJournalService->store($validatedStockJournal);
                    //dd("VoucherLevel", $stockJournal);
                    $data['stock_journal_id'] = $stockJournal->id ?? null;
                }
            }
            if (!isset($data['voucher_no']) || empty($data['voucher_no']) || $data['voucher_no'] === 'new') {
                // $voucher_type = Voucher::where('voucher_type_id', $data['voucher_type_id'])->first();
                $voucher_type_id = $data['voucher_type_id'];
                $company_id = $data['company_id'] ?? 1;
                $fiscal_year_id = $data['fiscal_year_id'] ?? 1;
                $branch_id = $data['branch_id'] ?? null;
                $voucher_no = $this->voucherNoService->getVoucherNo($voucher_type_id, $company_id, $fiscal_year_id, $branch_id);
                $data['voucher_no'] = $voucher_no;
            }

            $SANITIZED_DATA = [];
            // foreach ($data as $key => $value) {
            //     if (in_array($key, Voucher::getFillable(), true)) {
            //         $SANITIZED_DATA[$key] = $value;
            //     }
            // }
            // $voucher = Voucher::create($SANITIZED_DATA);

            //Avhisek Shaw Approach Start
            $voucherModel = new Voucher();

            foreach ($data as $key => $value) {
                if (in_array($key, $voucherModel->getFillable(), true)) {
                    $SANITIZED_DATA[$key] = $value;
                }
            }

            $voucher = Voucher::create($SANITIZED_DATA);

            //Avhisek Shaw Approach End
            // dd($data['voucher_entries']);

            if (!empty($data['voucher_entries'])) {
                foreach ($data['voucher_entries'] as $key => $voucher_entry) {
                    $voucher_entry['voucher_id'] = $voucher->id;
                    $rules = (new VoucherEntryRequest())->rules();
                    $validatedVoucherEntry = Validator::make($voucher_entry, $rules)->validate();
                    $data['voucher_entries'][$key] = $this->voucherEntryService->store($validatedVoucherEntry);
                }
            }
            if (!empty($data['voucher_dispatch_detail'])) {
                $data['voucher_dispatch_detail']['voucher_id'] = $voucher->id;
                $rules = (new VoucherDispatchDetailRequest())->rules();
                $validatedDispatchDetail = Validator::make($data['voucher_dispatch_detail'], $rules)->validate();
                $this->voucherDispatchDetailService->store($validatedDispatchDetail);
                // $voucher->voucher_dispatch_detail()->create($data['voucher_dispatch_detail']);
            }
            if (!empty($data['party'])) {
                $data['party']['voucher_id'] = $voucher->id;
                $rules = (new VoucherPartyRequest())->rules();
                $validatedParty = Validator::make($data['party'], $rules)->validate();
                //dump($validatedParty);
                $this->voucherPartyService->store($validatedParty);
                // $voucher->party()->create($validatedParty);
            }
            if (!empty($data['voucher_reference'])) {

                $data['voucher_reference']['voucher_id'] = $voucher->id;
                $rules = (new VoucherReferenceRequest())->rules();
                $validatedVoucherReference = Validator::make($data['voucher_reference'], $rules)->validate();
                $data['voucher_reference'] = app(VoucherReferenceServiceInterface::class)
                    ->store($validatedVoucherReference);

            }


            //dd($voucher);
            DB::commit();
            return $voucher;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function generateJournalNo(): string
    {
        // Implement your logic to generate a unique journal number
        $latestJournal = \App\Modules\StockJournal\Models\StockJournal::orderBy('id', 'desc')->first();
        $nextNumber = $latestJournal ? intval(substr($latestJournal->journal_no, -5)) + 1 : 1;
        return 'JRN-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    public function update(array $data, int $id): Voucher
    {
        DB::beginTransaction();
        try {
            $voucher = Voucher::findOrFail($id);

            if ($voucher->locked) {
                throw new \Exception('This voucher is locked and cannot be updated.');
            }

            if (isset($data['stock_journal']) && !empty($data['stock_journal'])) {

                if ($voucher->stock_journal_id) {

                    if (isset($data['stock_journal']['id']) && $data['stock_journal']['id'] == $voucher->stock_journal_id) {

                        $this->stockJournalService->update($data['stock_journal'], $data['stock_journal']['id']);

                    } else {
                        throw new \Exception(
                            'Stock Journal is already assigned to this voucher. Cannot assign a different stock journal.'
                        );
                    }

                } else {
                    $stock_journal = $data['stock_journal'];
                    $rules = (new StockJournalRequest)->rules();
                    $validatedStockJournal = Validator::make($stock_journal, $rules)->validate();
                    if (!empty($validatedStockJournal)) {

                        $stockJournal = $this->stockJournalService->store($validatedStockJournal);
                        // dd("VoucherLevel", $stockJournal);
                        $data['stock_journal_id'] = $stockJournal->id ?? null;
                    }
                }

                unset($data['stock_journal']);
            }


            if (!isset($data['voucher_no']) || empty($data['voucher_no']) || $data['voucher_no'] === 'new') {
                // $voucher_type = Voucher::where('voucher_type_id', $data['voucher_type_id'])->first();

                $voucher_type_id = $data['voucher_type_id'];
                $company_id = $data['company_id'] ?? 1;
                $fiscal_year_id = $data['fiscal_year_id'] ?? 1;
                $branch_id = $data['branch_id'] ?? null;

                $voucher_no = $this->voucherNoService->getVoucherNo($voucher_type_id, $company_id, $fiscal_year_id, $branch_id);
                $data['voucher_no'] = $voucher_no;
            }

            // Sanitize data before update
            $SANITIZED_DATA = [];
            foreach ($data as $key => $value) {
                if (in_array($key, $voucher->getFillable(), true)) {
                    $SANITIZED_DATA[$key] = $value;
                }
            }
            $voucher->fill($SANITIZED_DATA);
            // call Update if and only any value differs
            if ($voucher->isDirty()) {
                $voucher->update($SANITIZED_DATA);
            }
            // dd($voucher->toArray());
            // $voucher = Voucher::update($data);

            // dd($data['voucher_entries']);

            if (!empty($data['voucher_entries'])) {
                foreach ($data['voucher_entries'] as $key => $voucher_entry) {
                    $voucher_entry['voucher_id'] = $voucher->id;
                    $rules = (new VoucherEntryRequest)->rules();
                    $validatedVoucherEntry = Validator::make($voucher_entry, $rules)->validate();
                    if ($voucher_entry['id'] ?? false) {
                        // Update existing voucher entry
                        // check is_deleted flag
                        if (isset($validatedVoucherEntry['is_deleted']) && $validatedVoucherEntry['is_deleted']) {
                            $this->voucherEntryService->delete($voucher_entry['id']);

                            continue; // skip to next entry
                            //Hello Avhisek Shaw What you are doing here by "continue"?
                        } else {
                            // unset($validatedVoucherEntry['is_deleted']); //remove is_deleted flag before update
                            $this->voucherEntryService->update($validatedVoucherEntry, $voucher_entry['id']);
                        }
                    } else {
                        // Create new voucher entry
                        $data['voucher_entries'][$key] = $this->voucherEntryService->store($validatedVoucherEntry);
                    }
                }
            }
            if (!empty($data['voucher_dispatch_detail'])) {
                $data['voucher_dispatch_detail']['voucher_id'] = $voucher->id;
                $rules = (new VoucherDispatchDetailRequest)->rules();
                $validatedDispatchDetail = Validator::make($data['voucher_dispatch_detail'], $rules)->validate();
                if ($data['voucher_dispatch_detail']['id'] ?? false) {
                    // Update existing voucher dispatch detail
                    $this->voucherDispatchDetailService->update($validatedDispatchDetail, $data['voucher_dispatch_detail']['id']);
                } else {
                    // Create new voucher dispatch detail
                    $data['voucher_dispatch_detail'] = $this->voucherDispatchDetailService->store($validatedDispatchDetail);
                }
                // $voucher->voucher_dispatch_detail()->create($data['voucher_dispatch_detail']);
            }
            if (!empty($data['party'])) {
                $data['party']['voucher_id'] = $voucher->id;
                $rules = (new VoucherPartyRequest)->rules();
                $validatedParty = Validator::make($data['party'], $rules)->validate();
                // dump($validatedParty);
                if ($data['party']['id'] ?? false) {

                    // Update existing voucher party
                    $this->voucherPartyService->update($validatedParty, $data['party']['id']);
                } else {
                    // Create new voucher party
                    $this->voucherPartyService->store($validatedParty);
                }

                // $voucher->party()->create($validatedParty);
            }
            if (!empty($data['voucher_reference'])) {

                $data['voucher_reference']['voucher_id'] = $voucher->id;
                $rules = (new VoucherReferenceRequest)->rules();
                $validatedVoucherReference = Validator::make($data['voucher_reference'], $rules)->validate();
                $data['voucher_reference'] = app(VoucherReferenceServiceInterface::class)
                    ->store($validatedVoucherReference);

            }

            // dd($voucher);
            DB::commit();
            return $voucher->fresh();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    public function delete(int $id): bool
    {
        $record = Voucher::findOrFail($id);
        return $record->delete();
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

}
