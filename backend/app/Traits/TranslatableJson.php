<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TranslatableJson implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $value ? self::translatable($value, app()->getLocale()) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public static function translatable($attribute, $key = null)
    {
        $arr = json_decode($attribute, true);
        if (request()->has('edit_json')) {
            return $arr;
        }

        //bu middleware qilib yozib qoyildi setapplocale.php faylida
        // $accept_language = request()->header('Accept-Language');
        // if(!is_null($accept_language)){
        //     return $arr[$accept_language] ?? $arr[config('app.locale')] ?? '';
        // }

        // dd($arr);
        // return $arr[$key] ?? $arr[app()->getLocale()] ?? $arr[config('app.locale')];
        return $arr[$key] ?? $arr[config('app.locale')] ?? '';

    }
}
