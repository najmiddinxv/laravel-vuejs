<?php

namespace App\Http\Resources\V1;

use App\Models\Content\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "id"=> $this->id,
            "category_id" => new CategoryResource($this->whenLoaded('category')),
            // "category_id"=> $this->category_id,
            // "category" => [
            //     "id" => $this->category->id,
            //     "name" => $this->category->name
            // ],
            "title"=> $this->title,
            "slug"=> $this->slug,
            "description"=> $this->description,
            "main_image"=> [
                // 'large' => "/storage{$this->main_image['large']}",
                // 'medium' => "/storage{$this->main_image['medium']}",
                // 'small' => "/storage{$this->main_image['small']}",
            ],
            "view_count"=> $this->view_count,
            "status"=> $this->status,
            // 'links' => [
            //     'self' => 'link-value',
            // ],

            // 'data' => $this->collection->transform(function ($post) {
            //     return new PostResource($post);
            // }),
            // 'links' => $this->paginationLinks(), // Get pagination links
            // 'meta' => [
            //     'current_page' => $this->currentPage(),
            //     'per_page' => $this->perPage(),
            //     'total' => $this->total(),
            // ],
        ];
    }

    // public function withResponse(Request $request, JsonResponse $response): void
    // {
    //     $response->header('X-Value', 'True');
    // }

    // public function with(Request $request): array
    // {
    //     return [
    //         'meta' => [
    //             'key' => 'value',
    //         ],
    //     ];
    // }

}
