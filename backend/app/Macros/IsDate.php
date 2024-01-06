<?php

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Facades\Cache;

EloquentBuilder::macro('inDate', function (string $field): bool {
    $table = $this->getModel()->getTable();
    $dates = Cache::remember($table . 'inDate', 86400, function () use ($table
    ) {//60 * 60 * 24=day
        $keys = collect($this->getModel()->getCasts())
            ->filter(function ($value, $key) {
                if (str_contains($value, 'immutable_date')
                    || str_contains($value, 'datetime')
                    || str_contains($value, 'date')) {
                    return $key;
                }
            });

        return $keys->keys()->map(function ($key) use ($table) {
            return $table . '.' . $key; // Prefix with table name
        })->toArray();
    });
    $field = str_contains($field, '.') ? $field : $table . '.' . $field;

    return in_array($field, $dates);
});
