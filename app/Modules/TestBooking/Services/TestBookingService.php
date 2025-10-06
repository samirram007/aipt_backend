<?php

namespace App\Modules\TestBooking\Services;

use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\TestBooking\Contracts\TestBookingServiceInterface;
use App\Modules\TestBooking\Models\TestBooking;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

class TestBookingService implements TestBookingServiceInterface
{
    protected $resource=[];

    public function getAll(): Collection
    {
        return TestBooking::with($this->resource)->get();
    }

    public function getById(int $id): ?TestBooking
    {
        return TestBooking::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestBooking
    {
        $lastJournalId = StockJournal::orderBy('journal_no', 'desc')->value('journal_no');

        if ($lastJournalId) {
            $intJournalId = (int) $lastJournalId;
            $newJournalId = $intJournalId + 1;
            $lastJournalId = (string) $newJournalId;
        } else {
            $lastJournalId = 1;
        }



        $stockJournal = StockJournal::create([
            'journal_no' => (string) $lastJournalId,
            'journal_date' => Carbon::today()->toDateString(),
            'type'=> 'out'
        ]);

        if($stockJournal){
            foreach($data['tests'] as $journalEntry){
                $id = (int) $journalEntry['test_id'];
                $stockItem = StockItem::where('id',$id)->first();
                StockJournalEntry::create([
                    'stock_journal_id' => 1,
                    'stock_item_id' => $stockItem['id'],
                    'stock_unit_id' => $stockItem['stock_unit_id'],
                    'alternate_unit_id' => $stockItem['stock_unit_id'],
                    'unit_ratio' => 1.0,
                    'item_cost' => $stockItem['mrp'],
                    'quantity' => 1,
                    'rate' => $stockItem['standard_selling_price'],
                    'movement_type'=> 'out',
                ]);
            }
        }






        // StockJournal::create([
        //     'journal_no'=> $lastJournalId,

        // ]);

        return TestBooking::create($data);
    }

    public function update(array $data, int $id): TestBooking
    {
        $record = TestBooking::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestBooking::findOrFail($id);
        return $record->delete();
    }
}
