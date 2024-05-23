<?php

namespace App\Macros;

use Illuminate\Database\Eloquent\Builder;

class ColumnSearchMacros
{

    public static function whenJsonColumnLike()
    {
        Builder::macro('whenJsonColumnLike', function($column, $queryParam) {
            $lang = app()->getLocale();

            return $this->when(isset($queryParam[$column]), function($query) use ($column, $lang, $queryParam) {
                  $query->where("$column->$lang", 'ILIKE', '%' . $queryParam[$column] . '%');
            });

        });
    }

    public static function whenJsonColumnLikeForEachWord()
    {
        Builder::macro('whenJsonColumnLikeForEachWord', function($column, $queryParam) {
            $lang = app()->getLocale();
            return $this->when(isset($queryParam[$column]), function($query) use ($column, $lang, $queryParam) {

                    $words = array_filter(explode(' ', $queryParam[$column]));
                    $query->where(function (Builder $query) use ($column, $lang, $words) {
                        foreach ($words as $word) {
                            $query->orWhere("$column->$lang", 'ILIKE', "%$word%");
                        }
                    });
                });
        });
    }
    
}
