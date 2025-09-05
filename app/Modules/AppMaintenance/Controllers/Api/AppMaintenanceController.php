<?php

namespace App\Modules\AppMaintenance\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\AppMaintenance\Contracts\AppMaintenanceServiceInterface;
use App\Modules\AppMaintenance\Resources\AppMaintenanceResource;
use App\Modules\AppMaintenance\Resources\AppMaintenanceCollection;
use App\Modules\AppMaintenance\Requests\AppMaintenanceRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class AppMaintenanceController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AppMaintenanceServiceInterface $service)
    {
    }

    /**
     * @OA\Post(
     *     path="/api/swagger_generate",
     *     tags={"AppMaintenance"},
     *     summary="Generate Swagger Documentation",
     *     @OA\Response(
     *         response=201,
     *         description="Swagger generated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Swagger generated successfully"), )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *          )
     *  ),
     * )
     *
     */

    public function swaggerGenerate(): JsonResponse
    {
        try {

            Artisan::call('l5-swagger:generate');

           return  response()->json(['message' => 'Swagger generated successfully.'], 201);


        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/app_maintenance",
     *     tags={"AppMaintenance"},
     *     summary="Get all AppMaintenance",
     *     @OA\Response(
     *         response=200,
     *         description="AppMaintenance retrieved successfully",
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="AppMaintenance not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="AppMaintenance not found"),
     *         )
     *     )
     * )
     */
    public function index(): SuccessCollection
    {
        $data = $this->service->getAll();
        return new AppMaintenanceCollection($data);
    }

    public function show(int $id): SuccessResource
    {
        $data = $this->service->getById($id);
        return new AppMaintenanceResource($data);
    }

    public function store(AppMaintenanceRequest $request): SuccessResource
    {
        $data = $this->service->store($request->validated());
        return new AppMaintenanceResource($data, $messages = 'AppMaintenance created successfully');
    }

    public function update(AppMaintenanceRequest $request, int $id): SuccessResource
    {
        $data = $this->service->update($request->validated(), $id);
        return new AppMaintenanceResource($data, $messages = 'AppMaintenance updated successfully');
    }

    public function destroy(int $id): SuccessResource
    {
        $this->service->delete($id);
        return new AppMaintenanceResource(null, $messages = 'AppMaintenance updated successfully');
    }
}
