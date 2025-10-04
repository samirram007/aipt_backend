<?php

namespace App\Modules\Discipline\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Discipline\Contracts\DisciplineServiceInterface;
use App\Modules\Discipline\Resources\DisciplineResource;
use App\Modules\Discipline\Resources\DisciplineCollection;
use App\Modules\Discipline\Requests\DisciplineRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class DisciplineController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected DisciplineServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new DisciplineCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new DisciplineResource($data);
    }

    public function store(DisciplineRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new DisciplineResource($data, $messages='Discipline created successfully');
    }

    public function update(DisciplineRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new DisciplineResource($data, $messages='Discipline updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'Discipline deleted successfully':'Discipline not found',
        ]);
    }
}
