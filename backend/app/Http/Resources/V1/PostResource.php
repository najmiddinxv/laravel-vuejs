<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            // 'posts' => PostResource::collection($this->posts),
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
          
        ];
    }

    // public function withResponse($request, $response)
    // {
    //     // $jsonResponse = json_decode($response->getContent(), true);
    //     // unset($jsonResponse['links'],$jsonResponse['meta']);
    //     // $response->setContent(json_encode($jsonResponse['data']));
    //     $default['links']['custom'] = 'https://example.com';
    //     return $default;
    // }

    // public function paginationInformation($request, $paginated, $default)
    // {
    //     $default['links']['custom'] = 'https://example.com';
    
    //     return $default;
    // }

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
