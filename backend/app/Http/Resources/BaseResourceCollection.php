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
                
            // {
                
            //     "links": {
            //         "first": "http://127.0.0.1:8000/api/v1/posts?page=1",
            //         "last": "http://127.0.0.1:8000/api/v1/posts?page=3",
            //         "prev": null,
            //         "next": "http://127.0.0.1:8000/api/v1/posts?page=2"
            //     },
            //     "meta": {
            //         "current_page": 1,
            //         "from": 1,
            //         "last_page": 3,
            //         "links": [
            //             {
            //                 "url": null,
            //                 "label": "&laquo; Previous",
            //                 "active": false
            //             },
            //             {
            //                 "url": "http://127.0.0.1:8000/api/v1/posts?page=1",
            //                 "label": "1",
            //                 "active": true
            //             },
            //             {
            //                 "url": "http://127.0.0.1:8000/api/v1/posts?page=2",
            //                 "label": "2",
            //                 "active": false
            //             },
            //             {
            //                 "url": "http://127.0.0.1:8000/api/v1/posts?page=3",
            //                 "label": "3",
            //                 "active": false
            //             },
            //             {
            //                 "url": "http://127.0.0.1:8000/api/v1/posts?page=2",
            //                 "label": "Next &raquo;",
            //                 "active": false
            //             }
            //         ],
            //         "path": "http://127.0.0.1:8000/api/v1/posts",
            //         "per_page": 2,
            //         "to": 2,
            //         "total": 6
            //     }
            // }
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
