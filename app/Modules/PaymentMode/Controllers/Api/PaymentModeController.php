<?php

namespace App\Modules\PaymentMode\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\PaymentMode\Contracts\PaymentModeServiceInterface;
use App\Modules\PaymentMode\Resources\PaymentModeResource;
use App\Modules\PaymentMode\Resources\PaymentModeCollection;
use App\Modules\PaymentMode\Requests\PaymentModeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PaymentModeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PaymentModeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PaymentModeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PaymentModeResource($data);
    }

    public function store(PaymentModeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PaymentModeResource($data, $messages='PaymentMode created successfully');
    }

    public function update(PaymentModeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PaymentModeResource($data, $messages='PaymentMode updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'PaymentMode deleted successfully':'PaymentMode not found',
        ]);
    }
}
