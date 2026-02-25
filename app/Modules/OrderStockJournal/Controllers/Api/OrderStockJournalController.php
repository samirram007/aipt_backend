<?php

namespace App\Modules\OrderStockJournal\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\OrderStockJournal\Contracts\OrderStockJournalServiceInterface;
use App\Modules\OrderStockJournal\Resources\OrderStockJournalResource;
use App\Modules\OrderStockJournal\Resources\OrderStockJournalCollection;
use App\Modules\OrderStockJournal\Requests\OrderStockJournalRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class OrderStockJournalController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected OrderStockJournalServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new OrderStockJournalCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new OrderStockJournalResource($data);
    }

    public function store(OrderStockJournalRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new OrderStockJournalResource($data, $messages='OrderStockJournal created successfully');
    }

    public function update(OrderStockJournalRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new OrderStockJournalResource($data, $messages='OrderStockJournal updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'OrderStockJournal deleted successfully':'OrderStockJournal not found',
        ]);
    }
}
