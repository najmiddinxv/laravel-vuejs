<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class NewsResource extends JsonResource
{

    public function toArray($request): array
    {
        $lang = app()->getLocale();
        return [
            "id" => $this->id,
            "title" => $this->translate($lang)->title,
            "slug" => $this->translate($lang)->slug,
            'main_image' => $this->transformMainImage($lang),
            "category" => [
                "id" => $this->category_id,
                "name" => $this->category->name,
            ],
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
