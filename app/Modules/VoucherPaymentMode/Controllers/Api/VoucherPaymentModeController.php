<?php

namespace App\Modules\VoucherPaymentMode\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherPaymentMode\Contracts\VoucherPaymentModeServiceInterface;
use App\Modules\VoucherPaymentMode\Resources\VoucherPaymentModeResource;
use App\Modules\VoucherPaymentMode\Resources\VoucherPaymentModeCollection;
use App\Modules\VoucherPaymentMode\Requests\VoucherPaymentModeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherPaymentModeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherPaymentModeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherPaymentModeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherPaymentModeResource($data);
    }

    public function store(VoucherPaymentModeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherPaymentModeResource($data, $messages='VoucherPaymentMode created successfully');
    }

    public function update(VoucherPaymentModeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherPaymentModeResource($data, $messages='VoucherPaymentMode updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherPaymentMode deleted successfully':'VoucherPaymentMode not found',
        ]);
    }
}
