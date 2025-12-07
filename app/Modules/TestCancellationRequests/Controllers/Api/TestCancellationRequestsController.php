<?php

namespace App\Modules\TestCancellationRequests\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TestCancellationRequests\Contracts\TestCancellationRequestsServiceInterface;
use App\Modules\TestCancellationRequests\Resources\TestCancellationRequestsResource;
use App\Modules\TestCancellationRequests\Resources\TestCancellationRequestsCollection;
use App\Modules\TestCancellationRequests\Requests\TestCancellationRequestsRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TestCancellationRequestsController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TestCancellationRequestsServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TestCancellationRequestsCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TestCancellationRequestsResource($data);
    }

    public function store(TestCancellationRequestsRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TestCancellationRequestsResource($data, $messages='TestCancellationRequests created successfully');
    }

    public function update(TestCancellationRequestsRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TestCancellationRequestsResource($data, $messages='TestCancellationRequests updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'TestCancellationRequests deleted successfully':'TestCancellationRequests not found',
        ]);
    }
}
