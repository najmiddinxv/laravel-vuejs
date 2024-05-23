<?php

namespace App\Macros;

use Illuminate\Database\Eloquent\Builder;

class BuilderMacros
{
    public static function whenNameLike()
    {
        Builder::macro('whenNameLike', function($queryParam, $lang) {
            return $this->when(isset($queryParam['name']), function($query) use ($queryParam, $lang) {
                $query->where("name->$lang", 'ILIKE', '%' . $queryParam['name'] . '%');
            });
        });
    }
}
