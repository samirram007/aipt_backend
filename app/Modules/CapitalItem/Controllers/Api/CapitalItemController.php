<?php

namespace App\Modules\CapitalItem\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\CapitalItem\Contracts\CapitalItemServiceInterface;
use App\Modules\CapitalItem\Resources\CapitalItemResource;
use App\Modules\CapitalItem\Resources\CapitalItemCollection;
use App\Modules\CapitalItem\Requests\CapitalItemRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CapitalItemController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CapitalItemServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new CapitalItemCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new CapitalItemResource($data);
    }

    public function store(CapitalItemRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new CapitalItemResource($data, $messages='CapitalItem created successfully');
    }

    public function update(CapitalItemRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new CapitalItemResource($data, $messages='CapitalItem updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'CapitalItem deleted successfully':'CapitalItem not found',
        ]);
    }
}
