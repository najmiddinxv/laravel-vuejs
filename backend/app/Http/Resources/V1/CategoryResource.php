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
            // "parent"=>[
            //     $this->parent_id,
            //     $this->parent?->name
            // ],
            "categoryable_type"=> $this->categoryable_type,
            "name"=> $this->name,
            "icon"=> $this->icon,
            // "image"=> $this->image,
            'image' =>  $this->formatImageUrls($this->image),
            "order"=> $this->order,
            "posts_count"=> $this->posts_count,
            "children" => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }

    private function formatImageUrls(?array $images): ?array
    {
        if (!$images) {
            return null;
        }
        $baseFileUrl = 'storage';
        return [
            'large' => isset($images['large']) ? url("/{$baseFileUrl}{$images['large']}") : null,
            'medium' => isset($images['medium']) ? url("/{$baseFileUrl}{$images['medium']}") : null,
            'small' => isset($images['small']) ? url("/{$baseFileUrl}{$images['small']}") : null,
        ];
    }
}
