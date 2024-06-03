<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\BaseResourceCollection;

class CategoryCollection extends BaseResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'categories' => $this->collection->transform(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'order' => $category->order,
                    'children' => $category->relationLoaded('children') && $category->children->isNotEmpty() ? $this->transformCategories($category->children) : [],
                ];
            }),
            'pagination' => $this->pagination,
        ];
    }

    protected function transformCategories($categories)
    {
        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'order' => $category->order,
                'children' => $this->transformCategories($category->children), // Recursively transform children
            ];
        });
    }


    //yoki shunaqa chiqarish mumkin
    // public function toArray($request)
    // {
    //     return [
    //         'categories' => $this->collection,
    //         'pagination' => $this->pagination,
    //     ];
    // }

     //yoki mana shunaqa chiqarish mumkin
    // public function toArray($request)
    // {
    //     return [
    //         'categories' => $this->collection->transform(function($category) {
    //             return [
    //                 "id" => $category->id,
    //                 "name"=> $category->name,
    //                 "order"=> $category->order,
    //                 "children" => CategoryResource::collection($category->whenLoaded('children')),
    //             ];
    //         }),
    //         'pagination' => $this->pagination
    //     ];
    // }

}
