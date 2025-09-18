<?php

namespace App\Modules\Address\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Address\Contracts\AddressServiceInterface;
use App\Modules\Address\Resources\AddressResource;
use App\Modules\Address\Resources\AddressCollection;
use App\Modules\Address\Requests\AddressRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AddressServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AddressCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new AddressResource($data);
    }

    public function store(AddressRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new AddressResource($data, $messages='Address created successfully');
    }

    public function update(AddressRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new AddressResource($data, $messages='Address updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Address deleted successfully':'Address not found',
        ]);
    }
}
