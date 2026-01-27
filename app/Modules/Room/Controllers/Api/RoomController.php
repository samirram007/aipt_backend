<?php

namespace App\Modules\Room\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Room\Contracts\RoomServiceInterface;
use App\Modules\Room\Resources\RoomResource;
use App\Modules\Room\Resources\RoomCollection;
use App\Modules\Room\Requests\RoomRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected RoomServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new RoomCollection($data);
    }

    public function show(string $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new RoomResource($data);
    }

    public function store(RoomRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return  new RoomResource($data, $messages = 'Room created successfully');
    }

    public function update(RoomRequest $request, string $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new RoomResource($data, $messages = 'Room updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {

        $result = $this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result ? 'Room deleted successfully' : 'Room not found',
        ]);
    }
}
