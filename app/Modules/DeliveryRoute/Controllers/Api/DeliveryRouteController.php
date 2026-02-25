<?php

namespace App\Modules\DeliveryRoute\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\DeliveryRoute\Contracts\DeliveryRouteServiceInterface;
use App\Modules\DeliveryRoute\Resources\DeliveryRouteResource;
use App\Modules\DeliveryRoute\Resources\DeliveryRouteCollection;
use App\Modules\DeliveryRoute\Requests\DeliveryRouteRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DeliveryRouteController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DeliveryRouteServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DeliveryRouteCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DeliveryRouteResource($data);
    }

    public function store(DeliveryRouteRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DeliveryRouteResource($data, $messages='DeliveryRoute created successfully');
    }

    public function update(DeliveryRouteRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DeliveryRouteResource($data, $messages='DeliveryRoute updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'DeliveryRoute deleted successfully':'DeliveryRoute not found',
        ]);
    }
}
