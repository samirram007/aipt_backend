<?php

namespace App\Modules\StockSummary\Services;

use App\Modules\Godown\Models\Godown;
use App\Modules\StockItem\Models\StockItem;
use App\Modules\StockJournal\Models\StockJournal;
use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\StockJournalGodownEntry\Models\StockJournalGodownEntry;
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

        $items = StockItem::with([
            'stock_unit',
            'stock_journal_entries' => function ($query) use ($fiscalYearId) {
                $query->whereHas('stock_journal.voucher', function ($q) use ($fiscalYearId) {
                    $q->where('fiscal_year_id', $fiscalYearId)
                        ->where('stock_journal_id', '!=', null);
                });
            }
        ])->get();
        // $items = StockItem::with([
        //     'stock_unit',
        //     'stock_journal_entries.stock_journal.voucher' => function ($q) use ($fiscalYearId) {
        //         $q->where('fiscal_year_id', $fiscalYearId)->where('stock_journal_id', '!=', null);
        //     }
        // ])->get();
        $result = [];
        foreach ($items as $index => $item) {
            // $stock = $this->calculateStockInHand($item);
            $stock = $this->calculateItemTotal($item->stock_journal_entries);
            //dd($stock);
            $result[$index]['item_id'] = $item->id;
            $result[$index]['item_name'] = $item->name;
            $result[$index]['unit_code'] = $item->stock_unit ? $item->stock_unit->code : null;
            $result[$index]['unit_name'] = $item->stock_unit ? $item->stock_unit->name : null;
            $result[$index]['no_of_decimal_places'] = $item->stock_unit ? $item->stock_unit->no_of_decimal_places : null;
            $result[$index]['inward_quantity'] = $stock['in'];
            $result[$index]['outward_quantity'] = $stock['out'];
            $result[$index]['closing_quantity'] = $stock['balance'];


        }


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

    public function stock_in_hand_item_in_details(): array
    {
        $fiscalYearId = $this->userFiscalYear->fiscal_year_id;

        $items = StockItem::with([
            'stock_unit',
            'stock_journal_entries' => function ($query) use ($fiscalYearId) {
                $query->whereHas('stock_journal.voucher', function ($q) use ($fiscalYearId) {
                    $q->where('fiscal_year_id', $fiscalYearId)
                        ->where('stock_journal_id', '!=', null);
                });
            }
        ])->get();

        $result = [];

        foreach ($items as $item) {

            $godownCollection = [];

            // GROUP BY GODOWN ACROSS ALL ENTRIES
            $allGodownEntries = $item->stock_journal_entries
                ->flatMap(fn($e) => $e->stock_journal_godown_entries)
                ->groupBy('godown_id');
            //dump($allGodownEntries->toArray());

            foreach ($allGodownEntries as $godownId => $entries) {

                // $inwardQuantity = $entries
                //     ->where('movement_type', 'in')
                //     ->sum('actual_quantity');

                // $outwardQuantity = $entries
                //     ->where('movement_type', 'out')
                //     ->sum('actual_quantity');
                $godownTotal = $this->calculateGodownTotal($entries);

                $godown = $entries->first()->godown;

                $godownCollection[] = [
                    'godown_id' => $godown->id,
                    'godown_name' => $godown->name,
                    'godown_code' => $godown->code,
                    'inward_quantity' => $godownTotal['in'],
                    'outward_quantity' => $godownTotal['out'],
                    'closing_quantity' => $godownTotal['balance'],
                    // 'inward_quantity' => $inwardQuantity,
                    // 'outward_quantity' => $outwardQuantity,
                    // 'closing_quantity' => $inwardQuantity - $outwardQuantity,
                ];
            }

            $itemTotal = $this->calculateItemTotal($item->stock_journal_entries);

            //compare with $godownCollection  $itemTotal
            //dd($itemTotal);
            if ($godownCollection) {
                $calculatedInward = array_sum(array_column($godownCollection, 'inward_quantity'));
                $calculatedOutward = array_sum(array_column($godownCollection, 'outward_quantity'));
                $calculatedClosing = array_sum(array_column($godownCollection, 'closing_quantity'));
                if (
                    $calculatedClosing != $itemTotal['balance'] ||
                    $calculatedInward != $itemTotal['in'] ||
                    $calculatedOutward != $itemTotal['out']
                ) {

                    $falseQuantity = [
                        'godown_id' => null,
                        'godown_name' => 'Mismatch in total',
                        'godown_code' => null,
                        'inward_quantity' => $itemTotal['in'] - $calculatedInward,
                        'outward_quantity' => $itemTotal['out'] - $calculatedOutward,
                        'closing_quantity' => $itemTotal['balance'] - $calculatedClosing,
                    ];
                    //dd('Mismatch in totals for item ID: '.$item->id);
                    $godownCollection[] = $falseQuantity;
                }
            }



            $result[] = [
                'item_id' => $item->id,
                'item_name' => $item->name,
                'unit_code' => $item->stock_unit?->code,
                'unit_name' => $item->stock_unit?->name,
                'inward_quantity' => $itemTotal['in'],
                'outward_quantity' => $itemTotal['out'],
                'closing_quantity' => $itemTotal['balance'],
                'godown_details' => $godownCollection,
            ];
        }

        return $result;
    }

    protected function calculateItemTotal($stock_journal_entries): array|int|float
    {
        //dd($item_entry->toArray());
        $in = $stock_journal_entries
            ->where('movement_type', 'in')
            ->sum('actual_quantity');
        //dump($in);

        $out = $stock_journal_entries
            ->where('movement_type', 'out')
            ->sum('actual_quantity');
        // dump($in, $out);
        return ['in' => $in, 'out' => $out, 'balance' => $in - $out];
    }
    protected function calculateGodownTotal($stock_journal_godown_entries): array|int|float
    {
        //dd($godown_entry->toArray());
        $in = $stock_journal_godown_entries
            ->where('movement_type', 'in')
            ->sum('actual_quantity');

        $out = $stock_journal_godown_entries
            ->where('movement_type', 'out')
            ->sum('actual_quantity');
        //dd($in, $out);
        return ['in' => $in, 'out' => $out, 'balance' => $in - $out];
    }
    public function stock_in_hand_godown_in_details(): array
    {
        $fiscalYearId = $this->userFiscalYear->fiscal_year_id;

        $entries = StockJournalEntry::with([
            'stock_item.stock_unit',
            'storage_unit',
            'stock_journal.voucher'
        ])
            ->whereHas('stock_journal.voucher', function ($q) use ($fiscalYearId) {
                $q->where('fiscal_year_id', $fiscalYearId);
            })
            ->get();

        $grouped = [];

        foreach ($entries as $entry) {

            $key = $entry->stock_item_id . '_' . $entry->storage_unit_id;

            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'item_id' => $entry->stock_item->id,
                    'item_name' => $entry->stock_item->name,
                    'unit_code' => $entry->stock_item->stock_unit?->code,
                    'unit_name' => $entry->stock_item->stock_unit?->name,

                    'storage_unit_id' => $entry->storage_unit->id,
                    'storage_unit_name' => $entry->storage_unit->name,

                    'inward_quantity' => 0,
                    'outward_quantity' => 0,
                    'closing_quantity' => 0,
                ];
            }

            if ($entry->movement_type === 'in') {
                $grouped[$key]['inward_quantity'] += $entry->actual_quantity;
            } else {
                $grouped[$key]['outward_quantity'] += $entry->actual_quantity;
            }

            $grouped[$key]['closing_quantity'] =
                $grouped[$key]['inward_quantity']
                - $grouped[$key]['outward_quantity'];
        }

        return array_values($grouped);
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
