<?php

namespace App\Modules\BusinessReport\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\BusinessReport\Contracts\BusinessReportServiceInterface;
use App\Modules\BusinessReport\Resources\BusinessReportResource;
use App\Modules\BusinessReport\Resources\BusinessReportCollection;
use App\Modules\BusinessReport\Requests\BusinessReportRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Modules\BusinessReport\Requests\ReportRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Ramsey\Collection\Collection;

class BusinessReportController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected BusinessReportServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new BusinessReportCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new BusinessReportResource($data);
    }

    public function store(BusinessReportRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new BusinessReportResource($data, $messages = 'BusinessReport created successfully');
    }

    public function update(BusinessReportRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new BusinessReportResource($data, $messages = 'BusinessReport updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'BusinessReport deleted successfully' : 'BusinessReport not found',
        ]);
    }

    public function test_summary(string $start_date, string $end_date, ?int $departmentId = null): JsonResponse
    {
        $data = $this->service->test_summary($start_date, $end_date, $departmentId);
        return $data;
    }
    public function daily_collection(): JsonResponse
    {
        $data = $this->service->daily_collection();
        return $data;
    }
}
