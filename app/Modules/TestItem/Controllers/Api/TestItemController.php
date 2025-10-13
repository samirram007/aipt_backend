<?php

namespace App\Modules\TestItem\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TestItem\Contracts\TestItemServiceInterface;
use App\Modules\TestItem\Resources\TestItemResource;
use App\Modules\TestItem\Resources\TestItemCollection;
use App\Modules\TestItem\Requests\TestItemRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TestItemController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TestItemServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TestItemCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TestItemResource($data);
    }

    public function store(TestItemRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TestItemResource($data, $messages='TestItem created successfully');
    }

    public function update(TestItemRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TestItemResource($data, $messages='TestItem updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'TestItem deleted successfully':'TestItem not found',
        ]);
    }
}
