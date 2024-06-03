<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\BaseResourceCollection;

class PostCollection extends BaseResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'posts' => $this->collection,
            'pagination' => $this->pagination,
        ];
    }
}
