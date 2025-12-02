<?php

namespace App\Modules\StockSummary\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\StockSummary\Models\StockSummary;

interface StockSummaryServiceInterface
{
    public function stockInHand(): array;
    public function netStock(array $data): StockSummary;
    public function purchaseOrderOutstanding(): StockSummary;
    public function salebleStock(): StockSummary;
    public function salesOrderOutstanding(): StockSummary;
}
