<?php

namespace App\Modules\PaymentTransaction\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PaymentTransaction\Contracts\PaymentTransactionServiceInterface;
use App\Modules\PaymentTransaction\Resources\PaymentTransactionResource;
use App\Modules\PaymentTransaction\Resources\PaymentTransactionCollection;
use App\Modules\PaymentTransaction\Requests\PaymentTransactionRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PaymentTransactionController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PaymentTransactionServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PaymentTransactionCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PaymentTransactionResource($data);
    }

    public function store(PaymentTransactionRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PaymentTransactionResource($data, $messages='PaymentTransaction created successfully');
    }

    public function update(PaymentTransactionRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PaymentTransactionResource($data, $messages='PaymentTransaction updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PaymentTransaction deleted successfully':'PaymentTransaction not found',
        ]);
    }
}
