<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'slug'=> $this->slug,
            'description'=> $this->description,
            'view_count'=> $this->view_count,
            'status'=> $this->status,
            'slider'=> $this->slider,
            'main_image' => $this->formatImageUrls($this->main_image),
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name,
            ],
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'jsonplaceholderComments' => $this->jsonplaceholderComments,
            // 'category_id' => new CategoryResource($this->whenLoaded('category')),
            // 'meta' => [
            //     'key' => 'value',
            // ],
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
