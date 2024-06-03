<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\BaseResourceCollection;

class PageCollection extends BaseResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'pages' => $this->collection->transform(function($page) {
                return [
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'description' => $page->description,
                    'main_image' => $this->formatImageUrls($page->main_image),
                ];
            }),
            'pagination' => $this->pagination,
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
