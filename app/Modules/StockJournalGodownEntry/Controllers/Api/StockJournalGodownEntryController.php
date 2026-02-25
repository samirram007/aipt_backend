<?php

namespace App\Modules\StockJournalGodownEntry\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalGodownEntry\Contracts\StockJournalGodownEntryServiceInterface;
use App\Modules\StockJournalGodownEntry\Resources\StockJournalGodownEntryResource;
use App\Modules\StockJournalGodownEntry\Resources\StockJournalGodownEntryCollection;
use App\Modules\StockJournalGodownEntry\Requests\StockJournalGodownEntryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalGodownEntryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalGodownEntryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalGodownEntryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalGodownEntryResource($data);
    }

    public function store(StockJournalGodownEntryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalGodownEntryResource($data, $messages='StockJournalGodownEntry created successfully');
    }

    public function update(StockJournalGodownEntryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalGodownEntryResource($data, $messages='StockJournalGodownEntry updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalGodownEntry deleted successfully':'StockJournalGodownEntry not found',
        ]);
    }
}
