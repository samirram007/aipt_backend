<?php

namespace App\Modules\Amenity\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Amenity\Contracts\AmenityServiceInterface;
use App\Modules\Amenity\Resources\AmenityResource;
use App\Modules\Amenity\Resources\AmenityCollection;
use App\Modules\Amenity\Requests\AmenityRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AmenityController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AmenityServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AmenityCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new AmenityResource($data);
    }

    public function store(AmenityRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new AmenityResource($data, $messages='Amenity created successfully');
    }

    public function update(AmenityRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new AmenityResource($data, $messages='Amenity updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Amenity deleted successfully':'Amenity not found',
        ]);
    }
}
