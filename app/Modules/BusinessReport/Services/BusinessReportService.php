<?php

namespace App\Modules\BusinessReport\Services;

use App\Modules\BusinessReport\Contracts\BusinessReportServiceInterface;
use App\Modules\BusinessReport\Models\BusinessReport;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\JsonResource;
use Illuminate\Support\Facades\DB;

class BusinessReportService implements BusinessReportServiceInterface
{
    protected $resource = [];

    public function getAll(): Collection
    {
        return BusinessReport::with($this->resource)->get();
    }

    public function getById(int $id): ?BusinessReport
    {
        return BusinessReport::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): BusinessReport
    {
        return BusinessReport::create($data);
    }

    public function update(array $data, int $id): BusinessReport
    {
        $record = BusinessReport::findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = BusinessReport::findOrFail($id);
        return $record->delete();
    }

    public function test_summary(string $start_date, string $end_date, ?int $departmentId = null): JsonResponse
    {
        $allDepartmentTestSummary = DB::select('CALL allDepartmentTestSummaryReport(?,?)', [$start_date, $end_date]);
        $allDepartmentTestSummaryCount = DB::select('CALL allDepartmentTestSummaryCount(?,?)', [$start_date, $end_date]);

        $testSummaryReport = collect($allDepartmentTestSummary)->groupBy("voucher_no")->map(function ($rows) {
            $first = $rows->first();
            $totalAmount = $rows->sum(fn($r) => $r->amount);
            return [
                "voucherNo" => $first->voucher_no,
                "name" => $first->patient_name,
                "bookingDate" => $first->booking_date,
                "totalAmount" => $totalAmount,
                "tests" => $rows->map(fn($r) => [
                    "testName" => $r->test_name,
                    "amount" => $r->amount,
                    "printName" => $r->print_name,
                    "code" => $r->code,
                    "status" => $r->status
                ])->values()
            ];
        })->values();

        return response()->json([
            "message" => "Data Feteched successfully",
            "status" => true,
            "code" => 201,
            "success" => true,
            "data" => [
                "contents" => $testSummaryReport,
                "summary" => $allDepartmentTestSummaryCount[0]
            ]
        ]);
    }
}
