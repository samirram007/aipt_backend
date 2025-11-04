<?php

namespace App\Modules\StockJournalSerialNoEntry\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\StockJournalSerialNoEntry\Contracts\StockJournalSerialNoEntryServiceInterface;
use App\Modules\StockJournalSerialNoEntry\Resources\StockJournalSerialNoEntryResource;
use App\Modules\StockJournalSerialNoEntry\Resources\StockJournalSerialNoEntryCollection;
use App\Modules\StockJournalSerialNoEntry\Requests\StockJournalSerialNoEntryRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class StockJournalSerialNoEntryController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected StockJournalSerialNoEntryServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new StockJournalSerialNoEntryCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new StockJournalSerialNoEntryResource($data);
    }

    public function store(StockJournalSerialNoEntryRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new StockJournalSerialNoEntryResource($data, $messages='StockJournalSerialNoEntry created successfully');
    }

    public function update(StockJournalSerialNoEntryRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new StockJournalSerialNoEntryResource($data, $messages='StockJournalSerialNoEntry updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'StockJournalSerialNoEntry deleted successfully':'StockJournalSerialNoEntry not found',
        ]);
    }
}
