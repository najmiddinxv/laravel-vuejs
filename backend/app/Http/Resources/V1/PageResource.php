<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->description,
            'image' => $this->formatImageUrls($this->main_image),
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name,
            ],
            'status' => $this->status,
            'view_count' => $this->view_count,
            'slider' => $this->slider,
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
