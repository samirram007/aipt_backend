<?php

namespace App\Modules\TestCancellationRequest\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TestCancellationRequest\Contracts\TestCancellationRequestServiceInterface;
use App\Modules\TestCancellationRequest\Resources\TestCancellationRequestResource;
use App\Modules\TestCancellationRequest\Resources\TestCancellationRequestCollection;
use App\Modules\TestCancellationRequest\Requests\TestCancellationRequestRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TestCancellationRequestController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TestCancellationRequestServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TestCancellationRequestCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TestCancellationRequestResource($data);
    }

    public function store(TestCancellationRequestRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new TestCancellationRequestResource($data, $messages = 'Cancellation request has been processed successfully');
    }

    public function update(TestCancellationRequestRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TestCancellationRequestResource($data, $messages = 'TestCancellationRequest updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'TestCancellationRequest deleted successfully' : 'TestCancellationRequest not found',
        ]);
    }
}
