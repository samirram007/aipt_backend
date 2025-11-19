<?php

namespace App\Modules\VoucherDispatchDetail\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherDispatchDetail\Contracts\VoucherDispatchDetailServiceInterface;
use App\Modules\VoucherDispatchDetail\Resources\VoucherDispatchDetailResource;
use App\Modules\VoucherDispatchDetail\Resources\VoucherDispatchDetailCollection;
use App\Modules\VoucherDispatchDetail\Requests\VoucherDispatchDetailRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherDispatchDetailController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherDispatchDetailServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherDispatchDetailCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherDispatchDetailResource($data);
    }

    public function store(VoucherDispatchDetailRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherDispatchDetailResource($data, $messages='VoucherDispatchDetail created successfully');
    }

    public function update(VoucherDispatchDetailRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherDispatchDetailResource($data, $messages='VoucherDispatchDetail updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherDispatchDetail deleted successfully':'VoucherDispatchDetail not found',
        ]);
    }
}
