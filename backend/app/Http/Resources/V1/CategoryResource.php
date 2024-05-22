<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    // public $preserveKeys = true;

    
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "parent_id"=> $this->parent_id,
            "category_type"=> $this->category_type,
            "name"=> $this->name,
            "icon"=> $this->icon,
            "image"=> $this->image,
            "order"=> $this->order,
        ];
    }


    public function withResponse($request, $response)
    {
        $response->header('X-Custom-Header', 'Your-Value');
    }

}
