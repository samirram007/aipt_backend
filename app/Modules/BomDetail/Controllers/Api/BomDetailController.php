<?php

namespace App\Modules\BomDetail\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\BomDetail\Contracts\BomDetailServiceInterface;
use App\Modules\BomDetail\Resources\BomDetailResource;
use App\Modules\BomDetail\Resources\BomDetailCollection;
use App\Modules\BomDetail\Requests\BomDetailRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class BomDetailController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected BomDetailServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new BomDetailCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new BomDetailResource($data);
    }

    public function store(BomDetailRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new BomDetailResource($data, $messages='BomDetail created successfully');
    }

    public function update(BomDetailRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new BomDetailResource($data, $messages='BomDetail updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'BomDetail deleted successfully':'BomDetail not found',
        ]);
    }
}
