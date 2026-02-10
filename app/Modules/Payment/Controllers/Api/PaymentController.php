<?php

namespace App\Modules\Payment\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Payment\Contracts\PaymentServiceInterface;
use App\Modules\Payment\Resources\PaymentResource;
use App\Modules\Payment\Resources\PaymentCollection;
use App\Modules\Payment\Requests\PaymentRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PaymentServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PaymentCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new PaymentResource($data);
    }

    public function store(PaymentRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new PaymentResource($data, $messages = 'Payment created successfully');
    }

    public function update(PaymentRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new PaymentResource($data, $messages = 'Payment updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Payment deleted successfully' : 'Payment not found',
        ]);
    }


    public function freightPayments(int $freight_id): SuccessCollection
    {
        $data = $this->service->getPaymentsByFreightId($freight_id);
        return new PaymentCollection($data);
    }
}
