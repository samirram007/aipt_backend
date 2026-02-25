<?php

namespace App\Modules\VoucherClassification\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\VoucherClassification\Contracts\VoucherClassificationServiceInterface;
use App\Modules\VoucherClassification\Resources\VoucherClassificationResource;
use App\Modules\VoucherClassification\Resources\VoucherClassificationCollection;
use App\Modules\VoucherClassification\Requests\VoucherClassificationRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VoucherClassificationController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VoucherClassificationServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VoucherClassificationCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VoucherClassificationResource($data);
    }

    public function store(VoucherClassificationRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VoucherClassificationResource($data, $messages='VoucherClassification created successfully');
    }

    public function update(VoucherClassificationRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VoucherClassificationResource($data, $messages='VoucherClassification updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'VoucherClassification deleted successfully':'VoucherClassification not found',
        ]);
    }
}
