<?php

namespace App\Modules\DayBook\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\DayBook\Contracts\DayBookServiceInterface;
use App\Modules\DayBook\Resources\DayBookResource;
use App\Modules\DayBook\Resources\DayBookCollection;
use App\Modules\DayBook\Requests\DayBookRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Modules\DayBook\Resources\DistributorBookCollection;
use App\Modules\DayBook\Resources\DistributorBookResource;
use App\Modules\Voucher\Resources\VoucherCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DayBookController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DayBookServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();

        return new VoucherCollection($data);
    }
    public function dayBooksSelf(): SuccessCollection
    {
        $data = $this->service->dayBooksSelf();

        return new VoucherCollection($data);
    }


    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new DayBookResource($data);
    }

    public function store(DayBookRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new DayBookResource($data, $messages = 'DayBook created successfully');
    }

    public function update(DayBookRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new DayBookResource($data, $messages = 'DayBook updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'DayBook deleted successfully' : 'DayBook not found',
        ]);
    }
}
