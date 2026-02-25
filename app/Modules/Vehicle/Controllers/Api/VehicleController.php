<?php

namespace App\Modules\Vehicle\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Vehicle\Contracts\VehicleServiceInterface;
use App\Modules\Vehicle\Resources\VehicleResource;
use App\Modules\Vehicle\Resources\VehicleCollection;
use App\Modules\Vehicle\Requests\VehicleRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected VehicleServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new VehicleCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new VehicleResource($data);
    }

    public function store(VehicleRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new VehicleResource($data, $messages='Vehicle created successfully');
    }

    public function update(VehicleRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new VehicleResource($data, $messages='Vehicle updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Vehicle deleted successfully':'Vehicle not found',
        ]);
    }
}
