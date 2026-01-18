<?php

namespace App\Modules\StockJournal\Services;

use App\Modules\StockJournal\Contracts\StockJournalServiceInterface;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Contracts\StockJournalEntryServiceInterface;
use App\Modules\StockJournalEntry\Requests\StockJournalEntryRequest;
use App\Modules\StockJournalEntry\Services\StockJournalEntryService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class StockJournalService implements StockJournalServiceInterface
{

    protected $resource = [];
    protected $stockJournalEntryService;


    public function __construct(
        StockJournalEntryServiceInterface $stockJournalEntryService,
    ) {
        $this->stockJournalEntryService = $stockJournalEntryService;
    }

    public function getAll(): Collection
    {
        return StockJournal::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournal
    {
        return StockJournal::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournal
    {
        if (empty($data['journal_no'])) {
            $data['journal_no'] = $this->generateJournalNo();
        }
        if (empty($data['journal_date'])) {

            $data['journal_date'] = Carbon::now();

        }
        if (empty($data['type'])) {
            $data['type'] = 'in';
        }


        $stockJournal = StockJournal::create($data);

        if (!empty($data['stock_journal_entries'])) {
            foreach ($data['stock_journal_entries'] as $key => $entryData) {
                $entryData['stock_journal_id'] = $stockJournal->id;
                $rules = (new StockJournalEntryRequest())->rules();
                $validatedStockJournalEntry = Validator::make($entryData, $rules)->validate();

                $data['stock_journal_entries'][$key] = $this->stockJournalEntryService->store($validatedStockJournalEntry);
            }

        }
        return $stockJournal;
    }
    protected function generateJournalNo(): string
    {
        // Implement your logic to generate a unique journal number
        $latestJournal = \App\Modules\StockJournal\Models\StockJournal::orderBy('id', 'desc')->first();
        $nextNumber = $latestJournal ? intval(substr($latestJournal->journal_no, -5)) + 1 : 1;
        return 'JRN-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
    public function update(array $data, int $id): StockJournal
    {
        $record = StockJournal::findOrFail($id);
        $record->update($data);

         if (!empty($data['stock_journal_entries'])) {

          $this->checkDelete(
                $data['stock_journal_entries'],
                $record
            );

            $rules = (new StockJournalEntryRequest)->rules();

            foreach ($data['stock_journal_entries'] as $entryData) {

                $validatedEntry = Validator::make($entryData, $rules)->validate();

                if (!empty($entryData['id'])) {

                    $this->stockJournalEntryService->update(
                        $validatedEntry,
                        $entryData['id']
                    );

                } else {

                    $stockJournalEntry = $this->stockJournalEntryService->store($validatedEntry);
                }
            }

        }
        return $record->fresh();

    }

    public function delete(int $id): bool
    {
        $record = StockJournal::findOrFail($id);
        return $record->delete();
    }

    private function checkDelete($data, $record){
        $existingEntries = $this->stockJournalEntryService->getByStockJournalId($record->id);

            //delete entries not present in the update data
            foreach ($existingEntries as $existingEntry) {

                $found = false;

                foreach ($data as $entries) {
                    if (
                        isset($entries['id']) &&
                        $entries['id'] == $existingEntry->id
                    ) {
                        $found = true;
                        break;
                    }
                }

                if (!$found) {
                    $this->stockJournalEntryService->delete($existingEntry->id);
                }
            }
        }
    }