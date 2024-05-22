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
            "category_id" => new CategoryResource($this->whenLoaded('category')),
            "title"=> $this->title,
            "slug"=> $this->slug,
            "description"=> $this->description,
            "main_image"=> [
                'large' => "/storage{$this->main_image['large']}",
                'medium' => "/storage{$this->main_image['medium']}",
                'small' => "/storage{$this->main_image['small']}",
            ],
            "view_count"=> $this->view_count,
            "status"=> $this->status,
            // 'meta' => [
            //     'key' => 'value',
            // ],
        ];
    }


}
