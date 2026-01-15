<?php

namespace App\Modules\Facility\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Facility\Contracts\FacilityServiceInterface;
use App\Modules\Facility\Resources\FacilityResource;
use App\Modules\Facility\Resources\FacilityCollection;
use App\Modules\Facility\Requests\FacilityRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class FacilityController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected FacilityServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new FacilityCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new FacilityResource($data);
    }

    public function store(FacilityRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new FacilityResource($data, $messages = 'Facility created successfully');
    }

    public function update(FacilityRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new FacilityResource($data, $messages = 'Facility updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Facility deleted successfully' : 'Facility not found',
        ]);
    }
}
