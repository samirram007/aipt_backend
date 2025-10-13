<?php

namespace App\Modules\AppModuleFeature\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\AppModuleFeature\Contracts\AppModuleFeatureServiceInterface;
use App\Modules\AppModuleFeature\Resources\AppModuleFeatureResource;
use App\Modules\AppModuleFeature\Resources\AppModuleFeatureCollection;
use App\Modules\AppModuleFeature\Requests\AppModuleFeatureRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class AppModuleFeatureController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AppModuleFeatureServiceInterface $service) {}

    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AppModuleFeatureCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return  new AppModuleFeatureResource($data);
    }

    public function store(AppModuleFeatureRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
       return  new AppModuleFeatureResource($data, $messages='AppModuleFeature created successfully');
    }

    public function update(AppModuleFeatureRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return  new AppModuleFeatureResource($data, $messages='AppModuleFeature updated successfully');
    }

        public function destroy(int $id): JsonResponse
    {

        $result=$this->service->delete($id);
        return new JsonResponse([
            'status' => $result,
            'code' => 204,
            'message' => $result?'AppModuleFeature deleted successfully':'AppModuleFeature not found',
        ]);
    }
}
