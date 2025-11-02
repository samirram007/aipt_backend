<?php

namespace App\Modules\JobOrderHistory\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\JobOrderHistory\Contracts\JobOrderHistoryServiceInterface;
use App\Modules\JobOrderHistory\Resources\JobOrderHistoryResource;
use App\Modules\JobOrderHistory\Resources\JobOrderHistoryCollection;
use App\Modules\JobOrderHistory\Requests\JobOrderHistoryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class JobOrderHistoryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected JobOrderHistoryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new JobOrderHistoryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new JobOrderHistoryResource($data);
    }

    public function store(JobOrderHistoryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new JobOrderHistoryResource($data, $messages='JobOrderHistory created successfully');
    }

    public function update(JobOrderHistoryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new JobOrderHistoryResource($data, $messages='JobOrderHistory updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'JobOrderHistory deleted successfully':'JobOrderHistory not found',
        ]);
    }
}
