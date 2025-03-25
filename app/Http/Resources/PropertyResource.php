<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $owner = $this->owner;
        $tenant = $this->tenant;

        return [
            'id' => $this->id,
            'type' => $this->role,
            'rent' => $this->rent,
            'city' => $this->city,
            'address' => $this->address,

            // Nested resources
            'owner' => new UserResource($owner),
            'tenant' => new UserResource($tenant),
        ];
    }
}
