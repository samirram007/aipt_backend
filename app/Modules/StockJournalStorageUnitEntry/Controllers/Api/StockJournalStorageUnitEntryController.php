<?php

namespace App\Modules\StockJournalStorageUnitEntry\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalStorageUnitEntry\Contracts\StockJournalStorageUnitEntryServiceInterface;
use App\Modules\StockJournalStorageUnitEntry\Resources\StockJournalStorageUnitEntryResource;
use App\Modules\StockJournalStorageUnitEntry\Resources\StockJournalStorageUnitEntryCollection;
use App\Modules\StockJournalStorageUnitEntry\Requests\StockJournalStorageUnitEntryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalStorageUnitEntryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalStorageUnitEntryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalStorageUnitEntryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalStorageUnitEntryResource($data);
    }

    public function store(StockJournalStorageUnitEntryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalStorageUnitEntryResource($data, $messages='StockJournalStorageUnitEntry created successfully');
    }

    public function update(StockJournalStorageUnitEntryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalStorageUnitEntryResource($data, $messages='StockJournalStorageUnitEntry updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalStorageUnitEntry deleted successfully':'StockJournalStorageUnitEntry not found',
        ]);
    }
}
