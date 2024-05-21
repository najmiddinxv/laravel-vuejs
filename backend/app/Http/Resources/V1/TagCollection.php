<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\BaseResourceCollection;
use Illuminate\Http\Request;

class TagCollection extends BaseResourceCollection
{

    public function __construct($resource)
    {
        // dd($resource);
        // $resource = $resource->getCollection(); // Necessary to remove meta and links
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
           [
            'tags' => $this->collection,
            'pagination' => $this->pagination,
           ]
        ];
    }

}
