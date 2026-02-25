<?php

namespace App\Modules\StockJournalEntry\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalEntry\Contracts\StockJournalEntryServiceInterface;
use App\Modules\StockJournalEntry\Resources\StockJournalEntryResource;
use App\Modules\StockJournalEntry\Resources\StockJournalEntryCollection;
use App\Modules\StockJournalEntry\Requests\StockJournalEntryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalEntryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalEntryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalEntryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalEntryResource($data);
    }

    public function store(StockJournalEntryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalEntryResource($data, $messages='StockJournalEntry created successfully');
    }

    public function update(StockJournalEntryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalEntryResource($data, $messages='StockJournalEntry updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalEntry deleted successfully':'StockJournalEntry not found',
        ]);
    }
}
