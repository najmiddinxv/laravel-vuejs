<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "last_name"=> $this->last_name,
            "first_name"=> $this->first_name,
            "middle_name"=> $this->middle_name,
            "email"=> $this->email,
            "phone_number"=> $this->phone_number,
            "status"=> $this->status,
            "avatar"=> $this->avatar
        ];
    }
}
