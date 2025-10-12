<?php

namespace App\Modules\Holiday\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Holiday\Contracts\HolidayServiceInterface;
use App\Modules\Holiday\Resources\HolidayResource;
use App\Modules\Holiday\Resources\HolidayCollection;
use App\Modules\Holiday\Requests\HolidayRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class HolidayController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected HolidayServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new HolidayCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new HolidayResource($data);
    }

    public function store(HolidayRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new HolidayResource($data, $messages='Holiday created successfully');
    }

    public function update(HolidayRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new HolidayResource($data, $messages='Holiday updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Holiday deleted successfully':'Holiday not found',
        ]);
    }
}
