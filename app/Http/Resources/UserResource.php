<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $userPayments = $this->profile()->payments;
        $userTickets = $this->profile()->tickets;

        return [
            'id' => $this->id,
            'role' => $this->role,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'iban' => $this->iban,
            'bic' => $this->bic,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,

            // Nested resources
            'payments' => PaymentResource::collection($userPayments),
            'tickets' => PaymentResource::collection($userTickets),
        ];
    }
}
