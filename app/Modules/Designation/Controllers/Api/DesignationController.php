<?php

namespace App\Modules\Designation\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Designation\Contracts\DesignationServiceInterface;
use App\Modules\Designation\Resources\DesignationResource;
use App\Modules\Designation\Resources\DesignationCollection;
use App\Modules\Designation\Requests\DesignationRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DesignationController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DesignationServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DesignationCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DesignationResource($data);
    }

    public function store(DesignationRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DesignationResource($data, $messages='Designation created successfully');
    }

    public function update(DesignationRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DesignationResource($data, $messages='Designation updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Designation deleted successfully':'Designation not found',
        ]);
    }
}
