<?php

namespace App\Modules\Bom\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Bom\Contracts\BomServiceInterface;
use App\Modules\Bom\Resources\BomResource;
use App\Modules\Bom\Resources\BomCollection;
use App\Modules\Bom\Requests\BomRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class BomController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected BomServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new BomCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new BomResource($data);
    }

    public function store(BomRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new BomResource($data, $messages='Bom created successfully');
    }

    public function update(BomRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new BomResource($data, $messages='Bom updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Bom deleted successfully':'Bom not found',
        ]);
    }

    public function getBomByStockItemId(int $stockItemId): SuccessCollection
    {
        $data = $this->service->getBomByStockItemId($stockItemId);
        return new BomCollection($data);
    }
}
