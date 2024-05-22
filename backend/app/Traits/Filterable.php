<?php

namespace App\Traits;

use App\Http\Filters\BaseApiFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    // public function scopeFilter(Builder $builder, BaseApiFilter $filter): Builder|LengthAwarePaginator
    // {
    //     $filter->apply($builder);
    // }




    //this method from Filterable.txt
    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     */
    public function scopeFilter(Builder $builder, BaseApiFilter $filter)
    {
        return $filter->apply($builder);
    }
    // public function scopeFilter(Builder $builder, BaseApiFilter $filter): Builder|LengthAwarePaginator
    // {
    //     return $filter->apply($builder);
    // }
}
