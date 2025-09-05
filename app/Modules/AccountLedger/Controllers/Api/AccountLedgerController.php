<?php

namespace App\Modules\AccountLedger\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessCollection;
use App\Modules\AccountGroup\Resources\AccountGroupResource;
use App\Modules\AccountLedger\Contracts\AccountLedgerServiceInterface;
use App\Modules\AccountLedger\Resources\AccountLedgerResource;
use App\Modules\AccountLedger\Resources\AccountLedgerCollection;
use App\Modules\AccountLedger\Requests\AccountLedgerRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AccountLedgerController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AccountLedgerServiceInterface $service)
    {
    }

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AccountLedgerCollection($data);
    }

    public function show(int $id): ?SuccessResource
    {
        $data = $this->service->getById($id);
        return
            new AccountLedgerResource(
                $data,
                $message = 'AccountLedger retrieved successfully'
            );

    }

    public function store(AccountLedgerRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return
            new AccountGroupResource(
                $data,
                $message = 'AccountLedger created successfully',
            );
    }

    public function update(AccountLedgerRequest $request, int $id): SuccessResource
    {
        //dd($request->all());

        $data = $this->service->update($request->validated(), $id);
        return new AccountLedgerResource($data, $message = 'AccountLedger updated successfully');

    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'AccountLedger deleted successfully' : 'AccountLedger not found',
        ]);

    }
}
