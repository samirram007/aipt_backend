<?php

namespace App\Modules\StockJournalEntry\Services;

use App\Modules\StockJournalEntry\Contracts\StockJournalEntryServiceInterface;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\StockJournalGodownEntry\Contracts\StockJournalGodownEntryServiceInterface;
use App\Modules\StockJournalGodownEntry\Requests\StockJournalGodownEntryRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;

class StockJournalEntryService implements StockJournalEntryServiceInterface
{
    protected $resource = ['rate_unit'];



    public function __construct(
        protected StockJournalGodownEntryServiceInterface $stockJournalGodownEntryService,
    ) {

    }
    public function getAll(): Collection
    {
        return StockJournalEntry::with($this->resource)->get();
    }

    public function getById(int $id): ?StockJournalEntry
    {
        return StockJournalEntry::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): StockJournalEntry
    {
        $stockJournalEntry = StockJournalEntry::create($data);
        if (!empty($data['stock_journal_godown_entries'])) {
            foreach ($data['stock_journal_godown_entries'] as $key => $entryData) {

                $entryData['stock_journal_entry_id'] = $stockJournalEntry->id;
                $rules = (new StockJournalGodownEntryRequest())->rules();
                $validatedStockJournalGodownEntry = Validator::make($entryData, $rules)->validate();
                // dump($validatedStockJournalGodownEntry);
                $data['stock_journal_godown_entries'][$key] = $this->stockJournalGodownEntryService->store($validatedStockJournalGodownEntry);
            }
        }
        return $stockJournalEntry;
    }

    public function update(array $data, int $id): StockJournalEntry
    {
        $record = StockJournalEntry::findOrFail($id);
        $record->update($data);

        if (!empty($data['stock_journal_godown_entries'])) {
            $this->checkDelete($data['stock_journal_godown_entries'], $record);

            $rules = (new StockJournalGodownEntryRequest())->rules();

            foreach ($data['stock_journal_godown_entries'] as $godownData) {

                $validatedGodownEntry = Validator::make(
                    $godownData,
                    $rules
                )->validate();

                if (!empty($godownData['id'])) {

                    $this->stockJournalGodownEntryService->update(
                        $validatedGodownEntry,
                        $godownData['id']
                    );

                } else {
                    $this->stockJournalGodownEntryService->store(
                        $validatedGodownEntry
                    );
                }
            }
        }

        return $record->fresh();
    }

    public function getByStockJournalId(int $stockJournalId): Collection
    {
        return StockJournalEntry::with($this->resource)
            ->where('stock_journal_id', $stockJournalId)
            ->get();
    }

    public function delete(int $id): bool
    {
        $record = StockJournalEntry::findOrFail($id);
        return $record->delete();
    }

    private function checkDelete($data, $record){
        $existingEntries = $this->stockJournalGodownEntryService->getByStockJournalEntryId($record->id);
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
                    $this->stockJournalGodownEntryService->delete($existingEntry->id);
                }
            }
        }
    }
