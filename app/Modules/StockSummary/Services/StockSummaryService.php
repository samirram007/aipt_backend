<?php

namespace App\Modules\StockSummary\Services;

use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\StockSummary\Contracts\StockSummaryServiceInterface;
use App\Modules\StockSummary\Models\StockSummary;
use App\Modules\UserFiscalYear\Contracts\UserFiscalYearServiceInterface;
use App\Modules\UserFiscalYear\Models\UserFiscalYear;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;

class StockSummaryService implements StockSummaryServiceInterface
{
    protected $resource = [];

    protected $userFiscalYearService;
    protected $userFiscalYear;

    public function __construct(UserFiscalYearServiceInterface $userFiscalYearService)
    {
        $this->userFiscalYearService = $userFiscalYearService;

        $this->userFiscalYear = $this->userFiscalYearService->getByUserId(auth()->id());

    }

    public function stockInHand(): array
    {

        $fiscalYearId = $this->userFiscalYear->fiscal_year_id;

        //dump($fiscalYearId);
        // $stockJournals = StockJournal::whereHas('voucher', function ($q) use ($fiscalYearId) {
        //     $q->where('fiscal_year_id', $fiscalYearId);
        // })->get();
        // $stockJournalEntries = StockJournalEntry::with('voucher')->get();
        // dd($stockJournalEntries->toArray());
        // $items = StockItem::with('stock_journal_entries.voucher')->get();
        // use eager-loaded relation if available
        $items = StockItem::with([
            'stock_unit',
            'stock_journal_entries' => function ($query) use ($fiscalYearId) {
                $query->whereHas('stock_journal.voucher', function ($q) use ($fiscalYearId) {
                    $q->where('fiscal_year_id', $fiscalYearId)
                        ->where('stock_journal_id', '!=', null);
                });
            }
        ])->get();
        // dd($items->count());

        //dd($items->toArray());
        $result = [];
        foreach ($items as $index => $item) {
            $stock = $this->calculateStockInHand($item);
            //dd($stock);
            $result[$index]['item_id'] = $item->id;
            $result[$index]['item_name'] = $item->name;
            $result[$index]['unit_code'] = $item->stock_unit ? $item->stock_unit->code : null;
            $result[$index]['unit_name'] = $item->stock_unit ? $item->stock_unit->name : null;
            $result[$index]['inward_quantity'] = $stock['in'];
            $result[$index]['outward_quantity'] = $stock['out'];
            $result[$index]['closing_quantity'] = $stock['balance'];


        }
        // dd((object) $result);
        //dd($items->toArray());
        //  {
        //     "itemId": null,
        //     "itemName": null,
        //     "unitCode": null,
        //     "unitName": null,
        //     "openingQuantity": null,
        //     "openingAmount": null,
        //     "inwardQuantity": null,
        //     "inwardAmount": null,
        //     "outwardQuantity": null,
        //     "outwardAmount": null,
        //     "closingQuantity": null,
        //     "closingAmount": null
        // },

        return $result;


    }
    protected function calculateStockInHand(StockItem $item): array|int|float
    {
        // dump($item->toArray());
        $in = $item->stock_journal_entries
            ->where('movement_type', 'in')
            ->sum('actual_quantity');

        $out = $item->stock_journal_entries
            ->where('movement_type', 'out')
            ->sum('actual_quantity');
        // dump($in, $out);
        return ['in' => $in, 'out' => $out, 'balance' => $in - $out];
    }

    public function netStock(array $data): StockSummary
    {
        // Implement the logic to retrieve net stock
        return StockSummary::first(); // Example implementation
    }
    public function purchaseOrderOutstanding(): StockSummary
    {
        // Implement the logic to retrieve purchase order outstanding
        return StockSummary::first(); // Example implementation
    }
    public function salebleStock(): StockSummary
    {
        // Implement the logic to retrieve saleble stock
        return StockSummary::first(); // Example implementation
    }
    public function salesOrderOutstanding(): StockSummary
    {
        // Implement the logic to retrieve sales order outstanding
        return StockSummary::first(); // Example implementation
    }
}
