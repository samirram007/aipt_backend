<?php

namespace App\Modules\TestCancellationRequest\Services;

use App\Modules\StockJournalEntry\Models\StockJournalEntry;
use App\Modules\TestCancellationRequest\Contracts\TestCancellationRequestServiceInterface;
use App\Modules\TestCancellationRequest\Models\TestCancellationRequest;
use App\Modules\Voucher\Models\Voucher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TestCancellationRequestService implements TestCancellationRequestServiceInterface
{
    protected $resource = [
        'stock_journal_entry.stock_journal.voucher.voucher_patient.patient',
        'stock_journal_entry.stock_journal.voucher.voucher_patient.agent',
        'stock_journal_entry.stock_journal.voucher.voucher_patient.physician',
        'stock_journal_entry.stock_journal.voucher.voucher_references.voucher'
    ];


    protected $allResource = [
        'stock_journal_entry.stock_item',
        'stock_journal_entry.stock_journal.voucher.voucher_patient.patient',
        'stock_journal_entry.stock_journal.voucher.voucher_references.voucher'
    ];

    public function getAll(): JsonResponse
    {
        $testCancellationAll = TestCancellationRequest::with($this->allResource)->get();
        $testCancellationList =  $testCancellationAll->groupBy(fn($row) => $row->stock_journal_entry->stock_journal->voucher['voucher_no'])->map(function ($rows) {
            $first = $rows->first();
            return [
                "bookingNo" => $first->stock_journal_entry->stock_journal->voucher->voucher_no,
                "bookingDate" => $first->stock_journal_entry->stock_journal->voucher->voucher_date,
                "patientId" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient_id,
                "patientName" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->name,
                "patientGender" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->gender,
                "patientContact" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->contact_no,
                "agentName" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->agent->name,
                "physicianName" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->physician->name
            ];
        })->values();
        return response()->json([
            "message" => "Tests Cancelled fetched successfully",
            "status" => true,
            "code" => 200,
            "success" => true,
            "data" => $testCancellationList
        ]);
    }

    public function getByBookingNo(string $bookingNo): JsonResponse
    {
        $testCancellationAll = TestCancellationRequest::with($this->allResource)
            ->when($bookingNo, function ($q) use ($bookingNo) {
                $q->whereHas(
                    'stock_journal_entry.stock_journal.voucher',
                    fn($v) => $v->where('voucher_no', $bookingNo)
                );
            })
            ->get();

        $testCancellationList =  $testCancellationAll->groupBy(fn($row) => $row->stock_journal_entry->stock_journal->voucher['voucher_no'])->map(function ($rows) {
            $first = $rows->first();
            return [
                "bookingNo" => $first->stock_journal_entry->stock_journal->voucher->voucher_no,
                "bookingDate" => $first->stock_journal_entry->stock_journal->voucher->voucher_date,
                "patientId" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient_id,
                "patientName" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->name,
                "patientAge" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->age,
                "patientGender" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->gender,
                "patientContact" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->patient->contact_no,
                "agentName" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->agent->name,
                "physicianName" => $first->stock_journal_entry->stock_journal->voucher->voucher_patient->physician->name,
                'tests' => $rows->map(fn($r) => [
                    "id" => $r->id,
                    "stockJournalEntryId" => $r->stock_journal_entry->id,
                    "testName" => $r->stock_journal_entry->stock_item->name,
                    "testDate" => $r->stock_journal_entry->start_date,
                    "reportDate" => $r->stock_journal_entry->end_date,
                    "amount" => $r->stock_journal_entry->amount,
                    "status" => $r->status,
                    "remarks" => $r->remarks
                ])->values(),
                "voucher" => $first->stock_journal_entry->stock_journal->voucher
            ];
        })->first();

        return response()->json([
            "message" => "Tests Cancelled fetched successfully",
            "status" => true,
            "code" => 200,
            "success" => true,
            "data" => $testCancellationList
        ]);
    }

    public function getById(int $id): ?TestCancellationRequest
    {
        return TestCancellationRequest::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): TestCancellationRequest
    {
        return TestCancellationRequest::create([
            'stock_journal_entry_id' => $data['stock_journal_entry_id'],
            'status' => $data['status'],
            'remarks' => $data['remarks'],
            'requested_by' => Auth::id()
        ]);
    }

    public function update(array $data, int $id): TestCancellationRequest
    {
        $record = TestCancellationRequest::findOrFail($id);
        $record->update([
            'status' => $data['status'],
            'remarks' => $data['remarks'],
            'cancelled_by' => Auth::id()
        ]);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = TestCancellationRequest::findOrFail($id);
        return $record->delete();
    }
}
