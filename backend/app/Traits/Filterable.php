<?php

namespace App\Traits;

use App\Http\Filters\BaseApiFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, BaseApiFilter $filter)
    {
        $filter->apply($builder);
    }
}
