<?php

namespace App\Modules\JobOrder\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
use App\Modules\TestBooking\Resources\TestBookingResource;
use App\Modules\TestItem\Resources\TestItemResource;

class JobOrderResource extends SuccessResource
{
    public function toArray(Request $request): array
    {
        $reportFile = $this->report_file_name;

        $reportFilePath = $reportFile ? asset(str_replace('storage/', '', $reportFile)) : null;
        return [
            'id' => $this->id,
            'stockJournalId' => $this->stock_journal_id,
            'stockJournalEntryId' => $this->stock_journal_entry_id,
            'status'=> $this->status,
            'stockItemId' => $this->stock_item_id,
            'expectedStartDate' => $this->expected_start_date,
            'expectedEndDate' => $this->expected_end_date,
            'actualStartDate' => $this->actual_start_date,
            'actualEndDate' => $this->actual_end_date,
            'reportFile' => $this->report_file_name,
            'reportFilePath' => $reportFilePath,
            'testItem' => TestItemResource::make($this->whenLoaded('test_item')),
            'testBooking' => TestBookingResource::make($this->whenLoaded('test_booking'))
        ];
    }
}
