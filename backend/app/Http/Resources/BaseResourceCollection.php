<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResourceCollection extends ResourceCollection
{
    protected $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'path' => $resource->path(),
            'first_page_url' => $resource->path()."?page=1",
            'next_page_url' => $resource->path()."?page=".$resource->currentPage()+1,
            'last_page_url' => $resource->path()."?page=".$resource->lastPage(),
            'total' => $resource->total(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'from' => $resource->firstItem(),
            'to' => $resource->lastItem(),
            'last_page' => $resource->lastPage(),
            'prev_page_url' => $resource->currentPage() > 1 ? $resource->path()."?page=".$resource->currentPage()-1 : null,
                
        ];

        $resource = $resource->getCollection(); // Necessary to remove meta and links

        parent::__construct($resource);
    }

    // public function toArray($request)
    // {
    //     return [
    //         'data' => $this->collection,
    //         'pagination' => $this->pagination,
    //     ];
    // }

}
