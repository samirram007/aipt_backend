<?php

namespace App\Modules\FacilityAmenity\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\FacilityAmenity\Contracts\FacilityAmenityServiceInterface;
use App\Modules\FacilityAmenity\Resources\FacilityAmenityResource;
use App\Modules\FacilityAmenity\Resources\FacilityAmenityCollection;
use App\Modules\FacilityAmenity\Requests\FacilityAmenityRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class FacilityAmenityController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected FacilityAmenityServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new FacilityAmenityCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new FacilityAmenityResource($data);
    }

    public function store(FacilityAmenityRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new FacilityAmenityResource($data, $messages='FacilityAmenity created successfully');
    }

    public function update(FacilityAmenityRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new FacilityAmenityResource($data, $messages='FacilityAmenity updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'FacilityAmenity deleted successfully':'FacilityAmenity not found',
        ]);
    }
}
