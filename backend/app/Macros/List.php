<?php

use Illuminate\Database\{Eloquent\Builder as EloquentBuilder, Query\Builder as QueryBuilder};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\ArrayShape;

EloquentBuilder::macro('listType', $func = function (
    #[ArrayShape(['paginate', 'collection'])]
    string $type,
    string|int $limit = 30,
): LengthAwarePaginator|Collection {
    return $this->when($type == 'collection',
        fn($q): Collection => $q->when($limit !== 'all',
            fn($q) => $q->limit($limit))->get(),

        fn(EloquentBuilder $q): LengthAwarePaginator => $q->paginate($limit)
    );
});

QueryBuilder::macro('listType', $func);
