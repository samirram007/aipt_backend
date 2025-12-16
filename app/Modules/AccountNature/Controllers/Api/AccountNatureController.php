<?php

namespace App\Modules\AccountNature\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessCollection;
use App\Modules\AccountNature\Contracts\AccountNatureServiceInterface;
use App\Modules\AccountNature\Resources\AccountNatureResource;
use App\Modules\AccountNature\Resources\AccountNatureCollection;
use App\Modules\AccountNature\Requests\AccountNatureRequest;
use App\Http\Resources\SuccessResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AccountNatureController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AccountNatureServiceInterface $service)
    {
    }


    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        // dd(new AccountNatureCollection($data));

        return new AccountNatureCollection($data);
    }



    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new AccountNatureResource($data, $message = 'AccountNature retrieved successfully');
    }

    public function store(AccountNatureRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new AccountNatureResource($data, $message = 'AccountNature create successfully');

    }

    public function update(AccountNatureRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new AccountNatureResource($data, $message = 'AccountNature updated successfully');

    }




    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'AccountNature deleted successfully' : 'AccountNature not found',
        ]);
    }
}
