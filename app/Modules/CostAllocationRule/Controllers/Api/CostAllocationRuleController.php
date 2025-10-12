<?php

namespace App\Modules\CostAllocationRule\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\CostAllocationRule\Contracts\CostAllocationRuleServiceInterface;
use App\Modules\CostAllocationRule\Resources\CostAllocationRuleResource;
use App\Modules\CostAllocationRule\Resources\CostAllocationRuleCollection;
use App\Modules\CostAllocationRule\Requests\CostAllocationRuleRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CostAllocationRuleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CostAllocationRuleServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new CostAllocationRuleCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new CostAllocationRuleResource($data);
    }

    public function store(CostAllocationRuleRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new CostAllocationRuleResource($data, $messages='CostAllocationRule created successfully');
    }

    public function update(CostAllocationRuleRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new CostAllocationRuleResource($data, $messages='CostAllocationRule updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'CostAllocationRule deleted successfully':'CostAllocationRule not found',
        ]);
    }
}
