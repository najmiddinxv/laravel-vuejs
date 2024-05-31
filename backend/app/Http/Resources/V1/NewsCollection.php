<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\BaseResourceCollection;

class NewsCollection extends BaseResourceCollection
{

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        $lang = app()->getLocale();
        return [
            'news' => $this->collection->transform(function($news) use ($lang) {
                return [
                    "title" => $news->translate($lang)->title,
                    "slug" => $news->translate($lang)->slug,
                    "description" => $news->translate($lang)->description,
                    'main_image' => $this->transformMainImage($news, $lang),
                ];
            }),
            'pagination' => $this->pagination,
        ];
    }

    protected function transformMainImage($news, $lang)
    {
        $image = $news->translate($lang)->main_image ?: $news->translate('uz')->main_image;
        return [
            'large' => isset($image['large']) ? "/storage{$image['large']}" : null,
            'medium' => isset($image['medium']) ? "/storage{$image['medium']}" : null,
            'small' => isset($image['small']) ? "/storage{$image['small']}" : null,
        ];
    }
}
