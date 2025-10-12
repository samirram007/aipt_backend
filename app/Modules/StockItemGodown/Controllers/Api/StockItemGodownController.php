<?php

namespace App\Modules\StockItemGodown\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockItemGodown\Contracts\StockItemGodownServiceInterface;
use App\Modules\StockItemGodown\Resources\StockItemGodownResource;
use App\Modules\StockItemGodown\Resources\StockItemGodownCollection;
use App\Modules\StockItemGodown\Requests\StockItemGodownRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockItemGodownController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockItemGodownServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockItemGodownCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockItemGodownResource($data);
    }

    public function store(StockItemGodownRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockItemGodownResource($data, $messages='StockItemGodown created successfully');
    }

    public function update(StockItemGodownRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockItemGodownResource($data, $messages='StockItemGodown updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockItemGodown deleted successfully':'StockItemGodown not found',
        ]);
    }
}
