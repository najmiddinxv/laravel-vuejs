<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\BaseResourceCollection;

class TagCollection extends BaseResourceCollection
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'tags' => $this->collection,
            'pagination' => $this->pagination
        ];
    }

}
