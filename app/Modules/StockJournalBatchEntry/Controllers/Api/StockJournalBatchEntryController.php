<?php

namespace App\Modules\StockJournalBatchEntry\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalBatchEntry\Contracts\StockJournalBatchEntryServiceInterface;
use App\Modules\StockJournalBatchEntry\Resources\StockJournalBatchEntryResource;
use App\Modules\StockJournalBatchEntry\Resources\StockJournalBatchEntryCollection;
use App\Modules\StockJournalBatchEntry\Requests\StockJournalBatchEntryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalBatchEntryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalBatchEntryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalBatchEntryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalBatchEntryResource($data);
    }

    public function store(StockJournalBatchEntryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalBatchEntryResource($data, $messages='StockJournalBatchEntry created successfully');
    }

    public function update(StockJournalBatchEntryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalBatchEntryResource($data, $messages='StockJournalBatchEntry updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalBatchEntry deleted successfully':'StockJournalBatchEntry not found',
        ]);
    }
}
