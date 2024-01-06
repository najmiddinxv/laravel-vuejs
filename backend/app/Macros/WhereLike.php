<?php

use Illuminate\Database\{
    Eloquent\Builder as EloquentBuilder,
    Query\Builder as QueryBuilder
};
use Illuminate\Support\Carbon;

/**
 * @var array<string,Closure>|string|Closure $columns
 * @var string $search
 * @var string<'and','or'> $boolean
 */
EloquentBuilder::macro('whereLike', $whereLike =
    function (
        array|string|Closure $columns,
        string $search,
        string $boolean = 'and'
    ) {
        $search  = trim($search);
        $columns = \Arr::wrap($columns);
        $table   = $this->getModel()->getTable();
        $this->where(function ($query) use ($columns, $search, $table, $boolean) {
            foreach ($columns as $column) {
                if ($column instanceof Closure) {
                    $query->orWhere($column);
                } else {
                    $column = str_contains($column, '.') ? $column : $table . '.' . $column;

                    if ($this->isTranslatable($column)) {
                        foreach (config('settings.available_locales', []) as $lang) {
                            $query->orWhereLike("$column->$lang", $search);
                        }
                    } elseif (strtotime($search) && $this->isDate($column)) {
                        $time = Carbon::createFromTimestamp(strtotime($search));
                        $query->orWhereDate($column, 'ilike', $time);
                    } else {
                        $query->orWhere($column, 'ILIKE', "%$search%");
                    }
                }
            }
        }, boolean: $boolean);

        return $this;
    });

QueryBuilder::macro('whereLike', $whereLike);
EloquentBuilder::macro('orWhereLike', $orWhereLike = function (array|string|Closure $columns, string $search) {
    $this->whereLike($columns, $search, 'or');
});

QueryBuilder::macro('orWhereLike', $orWhereLike);

