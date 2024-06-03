<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name' => $this->name,
            'tagsable_type' => $this->tagsable_type,
        ];
    }
}
