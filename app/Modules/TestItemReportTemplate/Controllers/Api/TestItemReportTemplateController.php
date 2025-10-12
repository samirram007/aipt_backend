<?php

namespace App\Modules\TestItemReportTemplate\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TestItemReportTemplate\Contracts\TestItemReportTemplateServiceInterface;
use App\Modules\TestItemReportTemplate\Resources\TestItemReportTemplateResource;
use App\Modules\TestItemReportTemplate\Resources\TestItemReportTemplateCollection;
use App\Modules\TestItemReportTemplate\Requests\TestItemReportTemplateRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TestItemReportTemplateController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TestItemReportTemplateServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TestItemReportTemplateCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TestItemReportTemplateResource($data);
    }

    public function store(TestItemReportTemplateRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TestItemReportTemplateResource($data, $messages='TestItemReportTemplate created successfully');
    }

    public function update(TestItemReportTemplateRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TestItemReportTemplateResource($data, $messages='TestItemReportTemplate updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'TestItemReportTemplate deleted successfully':'TestItemReportTemplate not found',
        ]);
    }
}
