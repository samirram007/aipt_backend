<?php

namespace App\Modules\Unit\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Unit\Contracts\UnitServiceInterface;
use App\Modules\Unit\Resources\UnitResource;
use App\Modules\Unit\Resources\UnitCollection;
use App\Modules\Unit\Requests\UnitRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class UnitController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected UnitServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new UnitCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new UnitResource($data);
    }

    public function store(UnitRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new UnitResource($data, $messages='Unit created successfully');
    }

    public function update(UnitRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new UnitResource($data, $messages='Unit updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Unit deleted successfully':'Unit not found',
        ]);
    }
}
