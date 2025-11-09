<?php

namespace App\Modules\JobOrder\Services;

use App\Enums\JobStatus;
use App\Modules\JobOrder\Contracts\JobOrderServiceInterface;
use App\Modules\JobOrder\Models\JobOrder;
use App\Modules\JobOrderHistory\Models\JobOrderHistory;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Storage;

class JobOrderService implements JobOrderServiceInterface
{
    protected $resource=['test_item.test_item_report_templates.doctor','test_booking.voucher_patient.patient.address','test_booking.voucher_patient.physician'];

    public function getAll(): Collection
    {
        return JobOrder::with($this->resource)->get();
    }

    public function getById(int $id): ?JobOrder
    {
        return JobOrder::with($this->resource)->findOrFail($id);
    }

    public function store(array $data): JobOrder
    {
        try{
            DB::beginTransaction();
            $jobOrder =  JobOrder::create([
                "stock_journal_entry_id" => $data["stock_journal_entry_id"],
                "stock_item_id" => $data["stock_item_id"],
                "status" => $data["status"],
                "expected_start_date" => $data["start_date"],
                "expected_end_date" => $data["end_date"],
                "voucher_id" => $data["voucher_id"]
            ]);
            JobOrderHistory::create([
                'job_order_id' => $jobOrder->id,
                'status' => $data['status'],
            ]);

            DB::commit();

            return $jobOrder;

        }catch(Exception $e){
            Log::error('TestBooking store error: '.$e->getMessage(), ['trace'=>$e->getTraceAsString()]);
            DB::rollBack();
            throw $e;
        }
    }

    public function update(array $data, int $id): JobOrder
    {
        $statusEnum = JobStatus::tryFrom($data['status']);

        DB::beginTransaction();
        try{
            $record = JobOrder::findOrFail($id);

            JobOrderHistory::create([
                'job_order_id' => $record->id,
                'status' => (string)$statusEnum->value,
            ]);
            $record->update([
                'status' => (string)$statusEnum->value
            ]);
            DB::commit();
            return $record->fresh();
        }catch(Exception $e){
            Log::error('Job Order History create error'.$e->getMessage(),['trace'=>$e->getTraceAsString()]);
            DB::rollBack();
            throw $e;
        }

    }

    public function upload_report(int $id): ?JsonResponse
    {
        try {
            $jobOrder = JobOrder::findOrFail($id);

            if (!request()->hasFile('report_file')) {
                return response()->json([
                    'success' => false,
                    'message' => 'No report file provided.',
                ], 400);
            }

            $file = request()->file('report_file');

            $voucherId = $jobOrder->voucher_id;
            $timestamp = now()->format('Ymd_His');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = "{$voucherId}_{$timestamp}_{$originalName}.{$extension}";

            $path = $file->storeAs('reports', $filename, 'public');

            $jobOrder->report_file_name = $path;
            $jobOrder->save();

            $publicUrl = asset(str_replace('storage/', '', $path));

            return response()->json([
                'success' => true,
                'message' => 'Report uploaded successfully.',
                'file_path' => $publicUrl,
            ]);
        } catch (Exception $e) {
            Log::error('JobOrder upload_report error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to upload report file.',
            ], 500);
        }
    }

    public function destroyReport(int $id): ?JsonResponse
    {
        try {
        $jobOrder = JobOrder::findOrFail($id);

        if (!$jobOrder->report_file_name) {
            return response()->json([
                'success' => false,
                'message' => 'No report file found for this job order.',
            ], 404);
        }

        if (Storage::disk('public')->exists($jobOrder->report_file_name)) {
            Storage::disk('public')->delete($jobOrder->report_file_name);
        }

        $jobOrder->report_file_name = null;
        $jobOrder->save();

        return response()->json([
            'success' => true,
            'message' => 'Report deleted successfully.',
        ]);
    } catch (Exception $e) {
        Log::error('JobOrder destroy_report error: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Failed to delete report file.',
        ], 500);
    }
    }

    public function delete(int $id): bool
    {
        $record = JobOrder::findOrFail($id);
        return $record->delete();
    }
}
