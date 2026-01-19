<?php

namespace App\Modules\CapitalItemMaintenanceLog\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\CapitalItemMaintenanceLog\Contracts\CapitalItemMaintenanceLogServiceInterface;
use App\Modules\CapitalItemMaintenanceLog\Resources\CapitalItemMaintenanceLogResource;
use App\Modules\CapitalItemMaintenanceLog\Resources\CapitalItemMaintenanceLogCollection;
use App\Modules\CapitalItemMaintenanceLog\Requests\CapitalItemMaintenanceLogRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class CapitalItemMaintenanceLogController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected CapitalItemMaintenanceLogServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new CapitalItemMaintenanceLogCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new CapitalItemMaintenanceLogResource($data);
    }

    public function store(CapitalItemMaintenanceLogRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new CapitalItemMaintenanceLogResource($data, $messages='CapitalItemMaintenanceLog created successfully');
    }

    public function update(CapitalItemMaintenanceLogRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new CapitalItemMaintenanceLogResource($data, $messages='CapitalItemMaintenanceLog updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'CapitalItemMaintenanceLog deleted successfully':'CapitalItemMaintenanceLog not found',
        ]);
    }
}
