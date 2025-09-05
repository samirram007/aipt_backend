<?php

namespace App\Modules\User\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="UserResource",
     *     title="UserResource",
     *     description="User resource",
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="name", type="string", example="John Doe"),
     *     @OA\Property(property="email", type="string", format="email", example="john@example.com"),
     *     @OA\Property(property="username", type="string", example="johndoe"),
     *     @OA\Property(property="userType", type="string", example="user"),
     *     @OA\Property(property="role", type="string", example="admin"),
     *     @OA\Property(property="contactNo", type="string", example="1234567890"),
     * )
    */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'userType' => $this->user_type,
            'role' => $this->user_type,
            'contactNo' => $this->contact_no,
        ];
    }
}
