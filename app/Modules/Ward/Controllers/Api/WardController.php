<?php

namespace App\Modules\Ward\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Ward\Contracts\WardServiceInterface;
use App\Modules\Ward\Resources\WardResource;
use App\Modules\Ward\Resources\WardCollection;
use App\Modules\Ward\Requests\WardRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class WardController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected WardServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new WardCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new WardResource($data);
    }

    public function store(WardRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new WardResource($data, $messages='Ward created successfully');
    }

    public function update(WardRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new WardResource($data, $messages='Ward updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Ward deleted successfully':'Ward not found',
        ]);
    }
}
