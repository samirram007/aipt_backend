<?php

namespace App\Modules\Building\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Building\Contracts\BuildingServiceInterface;
use App\Modules\Building\Resources\BuildingResource;
use App\Modules\Building\Resources\BuildingCollection;
use App\Modules\Building\Requests\BuildingRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class BuildingController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected BuildingServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new BuildingCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new BuildingResource($data);
    }

    public function store(BuildingRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new BuildingResource($data, $messages='Building created successfully');
    }

    public function update(BuildingRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new BuildingResource($data, $messages='Building updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Building deleted successfully':'Building not found',
        ]);
    }
}
