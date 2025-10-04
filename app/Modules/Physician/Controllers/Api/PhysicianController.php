<?php

namespace App\Modules\Physician\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Physician\Contracts\PhysicianServiceInterface;
use App\Modules\Physician\Resources\PhysicianResource;
use App\Modules\Physician\Resources\PhysicianCollection;
use App\Modules\Physician\Requests\PhysicianRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class PhysicianController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected PhysicianServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new PhysicianCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new PhysicianResource($data);
    }

    public function store(PhysicianRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new PhysicianResource($data, $messages='Physician created successfully');
    }

    public function update(PhysicianRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new PhysicianResource($data, $messages='Physician updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Physician deleted successfully':'Physician not found',
        ]);
    }
}
