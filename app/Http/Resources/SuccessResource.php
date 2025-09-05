<?php


namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    protected string $message;
    protected int $successCode;


    public function __construct(
        $resource,
        string $message = null,
        int $successCode = 200
    ) {
        parent::__construct($resource);
        $this->message = $message ?? 'Record processed successfully';
        $this->successCode = $successCode;
    }

    public function toArray(Request $request): array
    {
        return is_array($this->resource) ? $this->resource : $this->resource->toArray();
    }

    public function with(Request $request): array
    {
        return [
            'status' => true,
            'code' => $this->successCode,
            'message' => $this->message,
        ];
    }
}
