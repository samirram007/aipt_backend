<?php

namespace App\Modules\OrderBook\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\OrderBook\Contracts\OrderBookServiceInterface;
use App\Modules\OrderBook\Resources\OrderBookResource;
use App\Modules\OrderBook\Resources\OrderBookCollection;
use App\Modules\OrderBook\Requests\OrderBookRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderBookController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OrderBookServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new OrderBookCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new OrderBookResource($data);
    }

    public function store(OrderBookRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new OrderBookResource($data, $messages='OrderBook created successfully');
    }

    public function update(OrderBookRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new OrderBookResource($data, $messages='OrderBook updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'OrderBook deleted successfully':'OrderBook not found',
        ]);
    }
}
