<?php

namespace App\Http\Filters\V1;

use App\Http\Filters\BaseApiFilter;
use App\Http\Requests\V1\CategoryRequest;

class CategoryFilter extends BaseApiFilter
{
    protected bool $pagination = true;
    protected int $defaultSize = 20;

    public function __construct(CategoryRequest $request)
    {
        parent::__construct($request);
    }

    public function defaultOrder()
    {
        $this->builder->orderBy('id', 'desc');
    }

    public function title(string $value): void
    {
        $this->builder->where("name->$this->lang", 'ILIKE', '%'.$value.'%');
    }



}
