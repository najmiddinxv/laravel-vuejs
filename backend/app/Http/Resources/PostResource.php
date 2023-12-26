<?php

namespace App\Http\Resources;

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
        return parent::toArray($request);
        // return [
        //     "id"=> $this->id,
        //     // "category_id"=> $this->category_id,
        //     // "category_id" => new CategoryResource($this->whenLoaded('category')),
        //     "category" => [
        //         "id" => $this->category->id,
        //         "name" => $this->category->name
        //     ],
        //     "title"=> $this->title,
        //     "slug"=> $this->slug,
        //     "description"=> $this->description,
        //     "image"=> $this->image,
        //     "view_count"=> $this->view_count,
        //     "status"=> $this->status,
        //     'links' => [
        //         'self' => 'link-value',
        //     ],
        // ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->header('X-Value', 'True');
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'key' => 'value',
            ],
        ];
    }

}
