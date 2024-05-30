<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;


class NewsDetailResource extends JsonResource
{

    public function toArray($request): array
    {
        $lang = app()->getLocale();
        return [
            "id" => $this->id,
            "title" => $this->translate($lang)->title,
            "slug" => $this->translate($lang)->slug,
            "description" => $this->translate($lang)->description,
            "body" => $this->translate($lang)->description,
            'main_image' => $this->transformMainImage($lang),
            "category" => [
                "id" => $this->category_id,
                "name" => $this->category->name,
            ],
            "tags" => TagResource::collection($this->whenLoaded('tags')),
            "view_count" => $this->view_count,
            "status" => $this->status,
            "slider" => $this->slider,
        ];
    }

    protected function transformMainImage($lang)
    {
        $image = $this->translate($lang)->main_image ?: $this->translate('uz')->main_image;
        return [
            'large' => isset($image['large']) ? "/storage{$image['large']}" : null,
            'medium' => isset($image['medium']) ? "/storage{$image['medium']}" : null,
            'small' => isset($image['small']) ? "/storage{$image['small']}" : null,
        ];
    }

}
