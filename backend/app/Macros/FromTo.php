<?php

use Illuminate\Database\{Eloquent\Builder as EloquentBuilder, Query\Builder as QueryBuilder};

/**
 * between
 * between[column]=fromTOto
 * between[column]=from
 * between[column]=TOto
 * between[amount]=200to400&between[price]=200&between[price]=to400
 */
EloquentBuilder::macro('fromTo', $function = function ($column, $from = null, $to = null) {
    $this->when($from, fn($q) => $q->where($column, '>=', $from))
        ->when($to, fn($q) => $q->where($column, '<=', $to));

    return $this;
});

QueryBuilder::macro('fromTo', $function);
