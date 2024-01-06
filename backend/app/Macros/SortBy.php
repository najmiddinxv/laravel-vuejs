<?php

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Validation\ValidationException;

EloquentBuilder::macro('sortBy', function (string|array $orderBy, string $sortBy) {
    $orderBy = Arr::wrap($orderBy);
    foreach ($orderBy as $field) {
        $this->orderBy($this->jsonTranslate($field), $sortBy);
    }

    return $this;
});

QueryBuilder::macro('sortBy', function (string|array $orderBy, string $sortBy) {
    $orderBy = Arr::wrap($orderBy);
    foreach ($orderBy as $field) {
        $this->orderBy($field, $sortBy);
    }

    return $this;
});
