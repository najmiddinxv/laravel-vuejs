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
            "id"=> $this->id,
            "title"=> $this->title,
            "slug"=> $this->slug,
            "description"=> $this->description,
            "view_count"=> $this->view_count,
            "status"=> $this->status,
            "slider"=> $this->slider,
            'main_image' => [
                'large' => isset($this->main_image['large']) ? "/storage{$this->main_image['large']}" : null,
                'medium' => isset($this->main_image['medium']) ? "/storage{$this->main_image['medium']}" : null,
                'small' => isset($this->main_image['small']) ? "/storage{$this->main_image['small']}" : null,
            ],
            "category" => [
                "id" => $this->category_id,
                "name" => $this->category->name,
            ],
            // "category_id" => new CategoryResource($this->whenLoaded('category')),
            "tags" => TagResource::collection($this->whenLoaded('tags')),
            // 'meta' => [
            //     'key' => 'value',
            // ],
            'jsonplaceholderComments' => $this->jsonplaceholderComments,
        ];
    }


}
