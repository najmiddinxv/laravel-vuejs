<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id"=> $this->id,
            "parent_id"=> $this->parent_id,
            "category_type"=> $this->category_type,
            "name"=> $this->name,
            "icon"=> $this->icon,
            "image"=> $this->image,
            "order"=> $this->order,
            // "created_at"=> $this->created_at,
            // "updated_at"=> $this->updated_at,
        ];
    }
}
