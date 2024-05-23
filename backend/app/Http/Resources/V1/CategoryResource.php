<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            // "parent_id"=> $this->parent_id,
            "parent"=>[
                $this->parent_id,
                $this->parent?->name
            ],
            "categoryable_type"=> $this->categoryable_type,
            "name"=> $this->name,
            "icon"=> $this->icon,
            "image"=> $this->image,
            "order"=> $this->order,
            "children"=>[
                $this->children?->id,
                $this->children?->name
            ],
        ];
    }
}
