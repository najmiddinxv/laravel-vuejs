<?php

use Illuminate\Database\Eloquent\Builder;

Builder::macro('whenNameLike', function($queryParam, $lang) {
    return $this->when(isset($queryParam['name']), function($query) use ($lang, $queryParam) {
        $query->where("name->$lang", 'ILIKE', '%' . $queryParam['name'] . '%');
    });
});
