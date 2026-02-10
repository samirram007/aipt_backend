<?php

namespace App\Modules\PaymentVoucher\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PaymentVoucher\Contracts\PaymentVoucherServiceInterface;
use App\Modules\PaymentVoucher\Resources\PaymentVoucherResource;
use App\Modules\PaymentVoucher\Resources\PaymentVoucherCollection;
use App\Modules\PaymentVoucher\Requests\PaymentVoucherRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PaymentVoucherController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PaymentVoucherServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PaymentVoucherCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PaymentVoucherResource($data);
    }

    public function store(PaymentVoucherRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PaymentVoucherResource($data, $messages='PaymentVoucher created successfully');
    }

    public function update(PaymentVoucherRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PaymentVoucherResource($data, $messages='PaymentVoucher updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PaymentVoucher deleted successfully':'PaymentVoucher not found',
        ]);
    }
}
