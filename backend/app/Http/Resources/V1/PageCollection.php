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
                    'category' => new CategoryResource($page->whenLoaded('category')), // qisqasi mana shunday chaqiramiz
                    // 'category' => new CategoryResource($page->category),
                    // 'category' => $page->category, // bu ham categoryni qaytaradi faqat n+1 qilib
                    // 'category' => $page->whenLoaded('category'), //bu ham categoryni qaytaradi lekin new CategoryResource($page->whenLoaded('category')) mana shunday qaytarsak bu cateforyni resoursga solib biz hohlaganday chiqaradi
                    //->with('category') // bu n+1 ni oldini olish uchun mana shu narsa controllerda yozilgan bo'lsa keyin resource filega shu kodni yozamiz $page->whenLoaded('category')
                    //bu degani qachonki controllerga ->with('category') shu yozilgan bo'lsa categoryni chaqir aks holda {} shunaqa pustoy qaytaradi

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
