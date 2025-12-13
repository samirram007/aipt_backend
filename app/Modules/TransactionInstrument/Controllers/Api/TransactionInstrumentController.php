<?php

namespace App\Modules\TransactionInstrument\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\TransactionInstrument\Contracts\TransactionInstrumentServiceInterface;
use App\Modules\TransactionInstrument\Resources\TransactionInstrumentResource;
use App\Modules\TransactionInstrument\Resources\TransactionInstrumentCollection;
use App\Modules\TransactionInstrument\Requests\TransactionInstrumentRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class TransactionInstrumentController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected TransactionInstrumentServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new TransactionInstrumentCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new TransactionInstrumentResource($data);
    }

    public function store(TransactionInstrumentRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new TransactionInstrumentResource($data, $messages='TransactionInstrument created successfully');
    }

    public function update(TransactionInstrumentRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new TransactionInstrumentResource($data, $messages='TransactionInstrument updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'TransactionInstrument deleted successfully':'TransactionInstrument not found',
        ]);
    }
}
