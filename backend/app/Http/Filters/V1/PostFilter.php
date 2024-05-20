<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\BaseApiFilter;
use App\Http\Requests\V1\PostRequest;

class PostFilter extends BaseApiFilter
{
    public function __construct(PostRequest $request)
    {
        parent::__construct($request);
    }

    public function defaultOrder()
    {
        $this->builder->orderBy('id', 'desc');
        // $this->builder->orderBy('created_at', 'desc');
    }

    // public function applyWith()
    // {}

    public function id(int $value): void
    {
        $this->builder->where('id','=',$value);
    }

    public function viewCount(string $value): void
    {
        $this->builder->orderBy('view_count', $value);
    }



}
