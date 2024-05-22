<?php

namespace App\Traits;

use App\Http\Filters\BaseApiFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     */
    public function scopeGetByFilter(Builder $builder, BaseApiFilter $filter)
    {
        return $filter->apply($builder);
    }
}
