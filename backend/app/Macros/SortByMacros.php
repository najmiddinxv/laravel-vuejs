<?php

namespace App\Macros;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SortByMacros
{
    public static function sortBy()
    {
        Builder::macro('sortBy', function ($column, $queryParam) {
            return $this->when(isset($queryParam[$column]), function($query) use ($column, $queryParam) {
                return $query->orderBy($column, $queryParam[$column]);
            });
        });
    }

    public static function sortByArr()
    {
         Builder::macro('sortByArr', function ($sortParams) {
            foreach ($sortParams as $column => $direction) {
                // $direction = strtolower($direction);
                // if (!in_array($direction, ['asc', 'desc'])) {
                //     $direction = 'asc'; // Default to 'asc' if direction is invalid
                // }
                $this->when(!is_null($column), function ($query) use ($column, $direction) {
                    return $query->orderBy($column, $direction);
                });
            }
            return $this;
        });
    }

    public static function sortByJsonField()
    {
        Builder::macro('sortByJsonField', function ($column, $queryParam) {
            $lang = app()->getLocale();
            $columnName = 'sort_by_'.$column;
            $sortBy = isset($queryParam[$columnName]) ? strtoupper($queryParam[$columnName]) : 'ASC';
            return $this->when(isset($queryParam[$columnName]), function($query) use ($column, $lang, $sortBy) {
                return $query->orderByRaw("$column->>'$lang' $sortBy");
            });
        });
    }

    // public static function sortByJson(){

        // Builder::macro('sortByJson', function (string|array $orderBy, string $sortBy) {
        //     $orderBy = Arr::wrap($orderBy);
        //     foreach ($orderBy as $field) {
        //         $this->orderBy($this->jsonTranslate($field), $sortBy);
        //     }
        //     return $this;
        // });

        // Builder::macro('jsonTranslate', function (string $field): string {
        //     $lang = app()->getLocale();
        //     return $this->isTranslatable($field) ? "$field->$lang" : $field;
        // });

        // Builder::macro('isTranslatable', function (string $field): bool {
        //     $table = $this->getModel()->getTable();
        //     $translatableFields = $this->getTranslatableFields($table);

        //     // Ensure the field is fully qualified
        //     $field = Str::contains($field, '.') ? $field : "$table.$field";

        //     return in_array($field, $translatableFields);
        // });

        // Builder::macro('getTranslatableFields', function (string $table): array {
        //     // return Cache::remember("$table.isTranslatable", 86400, function () use ($table) {
        //         $casts = $this->getModel()->getCasts();
        //         $translatableKeys = collect($casts)->filter(function ($value) {
        //             return Str::contains($value, 'TranslatableJson');
        //         });

        //         return $translatableKeys->keys()->map(fn($key) => "$table.$key")->toArray();
        //     // });
        // });

    //     EloquentBuilder::macro('sortBy', function (string|array $orderBy, string $sortBy) {
    //         $orderBy = Arr::wrap($orderBy);
    //         foreach ($orderBy as $field) {
    //             $this->orderBy($this->jsonTranslate($field), $sortBy);
    //         }

    //         return $this;
    //     });

    //     EloquentBuilder::macro('jsonTranslate', function (string $field): string {
    //         $lang = app()->getLocale();
    //         return $this->isTranslatable($field) ? "$field->$lang" : $field;
    //     });

    //     EloquentBuilder::macro('isTranslatable', function (string $field): bool {
    //         $table        = $this->getModel()->getTable();
    //         $translatable = Cache::remember($table . 'isTranslatable', 86400,
    //             function () use ($table) {//60 * 60 *24=day
    //                 $keys = collect($this->getModel()->getCasts())
    //                     ->filter(function ($value, $key) {
    //                         if (str_contains($value, 'TranslatableJson')) {
    //                             return $key;
    //                         }
    //                     });

    //                 return $keys->keys()->map(function ($key) use ($table) {
    //                     return $table . '.' . $key; // Prefix with table name
    //                 })->toArray();
    //             });
    //         $field = str_contains($field, '.') ? $field : $table . '.' . $field;

    //         return in_array($field, $translatable);
    //     });

    // }

    // Builder::macro('whenJsonColumnLikeForEachWord', function($column, $words) {
    //     $lang = app()->getLocale();

    //     return $this->when($words, function($query) use ($column, $lang, $words) {
    //         $wordsArr = array_filter(explode(' ', $words));

    //         $query->where(function (Builder $query) use ($column, $lang, $wordsArr) {
    //             foreach ($wordsArr as $word) {
    //                 $query->orWhere("$column->$lang", 'ILIKE', "%$word%");
    //             }
    //         });
    //     });
    // });


    // public static function whenJsonColumnLikeForEachWord()
    // {
    //     Builder::macro('whenJsonColumnLikeForEachWord', function($column, $queryParam) {
    //         $lang = app()->getLocale();
    //         return $this->when(isset($queryParam[$column]), function($query) use ($column, $lang, $queryParam) {
    //                 // $query->where("$column->$lang", 'ILIKE', '%' . $queryParam[$column] . '%');
    //                 $words = array_filter(explode(' ', $queryParam[$column]));
    //                 $query->where(function (Builder $query) use ($column, $lang, $words) {
    //                     foreach ($words as $word) {
    //                         $query->orWhere("$column->$lang", 'ILIKE', "%$word%");
    //                     }
    //                 });
    //             });
    //     });
    // }

    // public static function sortBy()
    // {

        // EloquentBuilder::macro('whereLike', $whereLike =
        // function (
        //     array|string|Closure $columns,
        //     string $search,
        //     string $boolean = 'and'
        // ) {
        //     $search  = trim($search);
        //     $columns = \Arr::wrap($columns);
        //     $table   = $this->getModel()->getTable();
        //     $this->where(function ($query) use ($columns, $search, $table, $boolean) {
        //         foreach ($columns as $column) {
        //             if ($column instanceof Closure) {
        //                 $query->orWhere($column);
        //             } else {
        //                 $column = str_contains($column, '.') ? $column : $table . '.' . $column;

        //                 if ($this->isTranslatable($column)) {
        //                     foreach (config('settings.available_locales', []) as $lang) {
        //                         $query->orWhereLike("$column->$lang", $search);
        //                     }
        //                 } elseif (strtotime($search) && $this->isDate($column)) {
        //                     $time = Carbon::createFromTimestamp(strtotime($search));
        //                     $query->orWhereDate($column, 'ilike', $time);
        //                 } else {
        //                     $query->orWhere($column, 'ILIKE', "%$search%");
        //                 }
        //             }
        //         }
        //     }, boolean: $boolean);

        //     return $this;
        // });

        // QueryBuilder::macro('whereLike', $whereLike);
        // EloquentBuilder::macro('orWhereLike', $orWhereLike = function (array|string|Closure $columns, string $search) {
        // $this->whereLike($columns, $search, 'or');
        // });

        // QueryBuilder::macro('orWhereLike', $orWhereLike);

        // EloquentBuilder::macro('listType', $func = function (
        //     #[ArrayShape(['paginate', 'collection'])]
        //     string $type,
        //     string|int $limit = 30,
        // ): LengthAwarePaginator|Collection {
        //     return $this->when($type == 'collection',
        //         fn($q): Collection => $q->when($limit !== 'all',
        //             fn($q) => $q->limit($limit))->get(),

        //         fn(EloquentBuilder $q): LengthAwarePaginator => $q->paginate($limit)
        //     );
        // });

        // QueryBuilder::macro('listType', $func);
    // }



    /**
        ---You can define Macros on any class that uses the Macroable trait. Here’s a list of classes and facades that are Macroable:
        Facades
        Cache
        File
        Lang
        Request
        Response
        Route
        URL

        ---Illuminate Classes

        Illuminate\Cache\Repository
        Illuminate\Console\Scheduling\Event
        Illuminate\Database\Eloquent\Builder
        Illuminate\Database\Eloquent\Relation
        Illuminate\Database\Query\Builder
        Illuminate\Filesystem\Filesystem
        Illuminate\Foundation\Testing\TestResponse
        Illuminate\Http\RedirectResponse
        Illuminate\Http\Request
        Illuminate\Http\UploadedFile
        Illuminate\Routing\ResponseFactory
        Illuminate\Routing\Router
        Illuminate\Routing\UrlGenerator
        Illuminate\Support\Arr
        Illuminate\Support\Collection
        Illuminate\Support\Str
        Illuminate\Translation\Translator
        Illuminate\Validation\Rule
    **/

}
