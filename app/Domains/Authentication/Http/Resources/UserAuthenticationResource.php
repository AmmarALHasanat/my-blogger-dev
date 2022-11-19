<?php

namespace App\Domains\Authentication\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthenticationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
	        'id'=> $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->createToken('auth_token')->plainTextToken,
        ];
    }
}