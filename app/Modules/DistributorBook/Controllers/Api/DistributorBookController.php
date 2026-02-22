<?php

namespace App\Modules\DistributorBook\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\DistributorBook\Contracts\DistributorBookServiceInterface;
use App\Modules\DistributorBook\Resources\DistributorBookResource;
use App\Modules\DistributorBook\Resources\DistributorBookCollection;
use App\Modules\DistributorBook\Requests\DistributorBookRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Modules\Voucher\Resources\VoucherCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DistributorBookController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DistributorBookServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DistributorBookCollection($data);
    }

    public function show(int $id): SuccessCollection
    {
        $data = $this->service->getById($id);
        return new VoucherCollection($data);
    }

    public function store(DistributorBookRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new DistributorBookResource($data, $messages = 'DistributorBook created successfully');
    }

    public function update(DistributorBookRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new DistributorBookResource($data, $messages = 'DistributorBook updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'DistributorBook deleted successfully' : 'DistributorBook not found',
        ]);
    }
}
