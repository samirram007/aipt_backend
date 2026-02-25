<?php

namespace App\Modules\GstRegistrationType\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\GstRegistrationType\Contracts\GstRegistrationTypeServiceInterface;
use App\Modules\GstRegistrationType\Resources\GstRegistrationTypeResource;
use App\Modules\GstRegistrationType\Resources\GstRegistrationTypeCollection;
use App\Modules\GstRegistrationType\Requests\GstRegistrationTypeRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class GstRegistrationTypeController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected GstRegistrationTypeServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new GstRegistrationTypeCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new GstRegistrationTypeResource($data);
    }

    public function store(GstRegistrationTypeRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new GstRegistrationTypeResource($data, $messages='GstRegistrationType created successfully');
    }

    public function update(GstRegistrationTypeRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new GstRegistrationTypeResource($data, $messages='GstRegistrationType updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'GstRegistrationType deleted successfully':'GstRegistrationType not found',
        ]);
    }
}
