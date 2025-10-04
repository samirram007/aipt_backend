<?php

namespace App\Modules\DiscountType\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\DiscountType\Contracts\DiscountTypeServiceInterface;
use App\Modules\DiscountType\Resources\DiscountTypeResource;
use App\Modules\DiscountType\Resources\DiscountTypeCollection;
use App\Modules\DiscountType\Requests\DiscountTypeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DiscountTypeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DiscountTypeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DiscountTypeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DiscountTypeResource($data);
    }

    public function store(DiscountTypeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DiscountTypeResource($data, $messages='DiscountType created successfully');
    }

    public function update(DiscountTypeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DiscountTypeResource($data, $messages='DiscountType updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'DiscountType deleted successfully':'DiscountType not found',
        ]);
    }
}
