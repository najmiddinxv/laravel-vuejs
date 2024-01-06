<?php

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

EloquentBuilder::macro('jsonTranslate', function (string $field, string $lang = null): string {
    $lang = $lang ?? app()->getLocale();

    return $this->isTranslatable($field) ? "$field->$lang" : $field;
});

EloquentBuilder::macro('isTranslatable', function (string $field): bool {
    $table        = $this->getModel()->getTable();
    $translatable = Cache::remember($table . 'isTranslatable', 86400,
        function () use ($table) {//60 * 60 *24=day
            $keys = collect($this->getModel()->getCasts())
                ->filter(function ($value, $key) {
                    if (str_contains($value, 'TranslatableJson')) {
                        return $key;
                    }
                });

            return $keys->keys()->map(function ($key) use ($table) {
                return $table . '.' . $key; // Prefix with table name
            })->toArray();
        });
    $field = str_contains($field, '.') ? $field : $table . '.' . $field;

    return in_array($field, $translatable);
});
