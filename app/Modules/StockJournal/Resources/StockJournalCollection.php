<?php

namespace App\Modules\StockJournal\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class StockJournalCollection extends SuccessCollection
{

         /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
