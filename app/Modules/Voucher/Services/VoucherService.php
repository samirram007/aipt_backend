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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class VoucherService implements VoucherServiceInterface
{
    protected $resource = [
        'voucher_entries.account_ledger',
        'voucher_type',
        'stock_journal.stock_journal_entries.rate_unit',
        'stock_journal.stock_journal_entries.stock_item.stock_unit',
        'stock_journal.stock_journal_entries.stock_item.alternate_stock_unit',
        'stock_journal.stock_journal_entries.alternate_unit',
        'stock_journal.stock_journal_entries.stock_journal_godown_entries',
        'voucher_party',
        'voucher_dispatch_detail',
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
        $vouchers = Voucher::with($this->resource)->orderByDesc('created_at')->get();
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


        if (!isset($data['voucher_no']) || empty($data['voucher_no']) || $data['voucher_no'] === 'new') {
            // $voucher_type = Voucher::where('voucher_type_id', $data['voucher_type_id'])->first();

            $voucher_type_id = $data['voucher_type_id'];
            $company_id = $data['company_id'] ?? 1;
            $fiscal_year_id = $data['fiscal_year_id'] ?? 1;
            $branch_id = $data['branch_id'] ?? null;

            $voucher_no = $this->voucherNoService->getVoucherNo($voucher_type_id, $company_id, $fiscal_year_id, $branch_id);
            $data['voucher_no'] = $voucher_no;
        }

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

        $voucher = Voucher::create($data);

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
            $this->voucherPartyService->store($validatedParty);
            // $voucher->party()->create($validatedParty);
        }

        //dd($voucher);
        return $voucher;
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
        $record = Voucher::findOrFail($id);
        $record->update($data);
        return $record->fresh();
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
