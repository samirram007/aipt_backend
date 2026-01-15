<?php

namespace App\Modules\Floor\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Floor\Contracts\FloorServiceInterface;
use App\Modules\Floor\Resources\FloorResource;
use App\Modules\Floor\Resources\FloorCollection;
use App\Modules\Floor\Requests\FloorRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class FloorController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected FloorServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new FloorCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new FloorResource($data);
    }

    public function store(FloorRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new FloorResource($data, $messages='Floor created successfully');
    }

    public function update(FloorRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new FloorResource($data, $messages='Floor updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Floor deleted successfully':'Floor not found',
        ]);
    }
}
