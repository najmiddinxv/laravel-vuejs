<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseResourceCollection extends ResourceCollection
{
    protected $pagination;

    public function __construct($resource)
    {
        if ($resource instanceof LengthAwarePaginator) {
            $this->pagination = [
                'first_page_url' => $resource->url(1),
                'last_page_url' => $resource->url($resource->lastPage()),
                'prev_page_url' => $resource->previousPageUrl(),
                'next_page_url' => $resource->nextPageUrl(),
                'current_page' => $resource->currentPage(),
                'from' => $resource->firstItem(),
                'last_page' => $resource->lastPage(),
                'path' => $resource->path(),
                'per_page' => $resource->perPage(),
                'to' => $resource->lastItem(),
                'total' => $resource->total(),
                // 'links' => $this->formatLinks($resource)
                // // bu paginatsiyani soni bo'yicha link yaratib tashaydi
                // // 'links' => $this->formatLinks($resource->linkCollection()->toArray())
            ];
            $resource = $resource->getCollection(); // Necessary to remove meta and links
        } else if (!($resource instanceof Collection)) {
            // throw new \InvalidArgumentException('The resource must be an instance of LengthAwarePaginator or Collection.');
            $resource = $resource->getCollection();
        }

        parent::__construct($resource);
    }

    //links ni nechta chiqishini o'zimiz belgilaymiz
    // private function formatLinks($resource)
    // {
    //     $links = [];

    //     // Previous page link
    //     $links[] = [
    //         'url' => $resource->previousPageUrl(),
    //         'label' => '&laquo; Previous',
    //         'active' => false
    //     ];

    //     // Current page link
    //     $links[] = [
    //         'url' => $resource->url($resource->currentPage()),
    //         'label' => (string) $resource->currentPage(),
    //         'active' => true
    //     ];

    //     // Adding next three pages links for demonstration
    //     for ($i = 1; $i <= 2; $i++) {
    //         $pageNumber = $resource->currentPage() + $i;
    //         if ($pageNumber <= $resource->lastPage()) {
    //             $links[] = [
    //                 'url' => $resource->url($pageNumber),
    //                 'label' => (string) $pageNumber,
    //                 'active' => false
    //             ];
    //         }
    //     }

    //     // Next page link
    //     $nextPage = $resource->currentPage() < $resource->lastPage() ? $resource->currentPage() + 1 : null;
    //     $links[] = [
    //         'url' => $nextPage ? $resource->url($nextPage) : null,
    //         'label' => 'Next &raquo;',
    //         'active' => false
    //     ];

    //     return $links;
    // }

    //links ni sonini biz belgila olmyamiz bu yerda ko'p chiqib ketadi
    // protected function formatLinks($links)
    // {
    //     return array_map(function ($link) {
    //         return [
    //             'url' => $link['url'],
    //             'label' => $link['label'],
    //             'active' => $link['active'],
    //         ];
    //     }, $links);
    // }
}
