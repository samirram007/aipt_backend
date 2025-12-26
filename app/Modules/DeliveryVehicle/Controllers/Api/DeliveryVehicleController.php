<?php

namespace App\Modules\DeliveryVehicle\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\DeliveryVehicle\Contracts\DeliveryVehicleServiceInterface;
use App\Modules\DeliveryVehicle\Resources\DeliveryVehicleResource;
use App\Modules\DeliveryVehicle\Resources\DeliveryVehicleCollection;
use App\Modules\DeliveryVehicle\Requests\DeliveryVehicleRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DeliveryVehicleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DeliveryVehicleServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DeliveryVehicleCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DeliveryVehicleResource($data);
    }

    public function store(DeliveryVehicleRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DeliveryVehicleResource($data, $messages='DeliveryVehicle created successfully');
    }

    public function update(DeliveryVehicleRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DeliveryVehicleResource($data, $messages='DeliveryVehicle updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'DeliveryVehicle deleted successfully':'DeliveryVehicle not found',
        ]);
    }
}
