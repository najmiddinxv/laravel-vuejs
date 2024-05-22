<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\BaseApiFilter;
use App\Http\Requests\V1\PostRequest;

class PostFilter extends BaseApiFilter
{
    protected bool $pagination = true;
    protected int $defaultSize = 20;

    public function __construct(PostRequest $request)
    {
        parent::__construct($request);
    }

    // public function applyWith()
    // {}

    public function defaultOrder()
    {
        $this->builder->orderBy('id', 'desc');
    }

    public function viewCount(string $value): void
    {
        $this->builder->orderBy('view_count', $value);
    }

    public function title(string $value): void
    {
        $this->builder->where("title->$this->lang", 'ILIKE', '%'.$value.'%');

        //har bitta so'z bo'yicha izlash
        // {{localhost}}/api/v1/posts?title=Tempora inventore ve
        // {{localhost}}/api/v1/posts?title=Tempora%20inventore%20ve

        // $words = array_filter(explode(' ', $value));
        // $this->builder->where(function (Builder $query) use ($words) {
        //     foreach ($words as $word) {
        //         $query->orWhere("title->$this->lang", 'ILIKE', "%$word%");
        //     }
        // });

        //tepadagi sql queryning sql ko'rinishi
        /**
         select
            from
            "posts"
            where
            (
                "title" ->> 'uz' :: text ILIKE '%Tempora%'
                or "title" ->> 'uz' :: text ILIKE '%inventore%'
                or "title" ->> 'uz' :: text ILIKE '%ve%'
            )
            and "status" = 1
            order by
            "id" desc
            limit
            50 offset 0
        **/
    }

}
