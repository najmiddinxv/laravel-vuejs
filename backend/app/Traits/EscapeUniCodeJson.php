<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait EscapeUniCodeJson
{
    //bu traitni use qilib modelga qo'shib qo'ysak use EscapeUniCodeJson;
    //   Post::create([
    //     'category_id' => 1,
    //     'title' => [
    //         'uz' => 'Нажмиддин in English',
    //         'ru' => 'Naam in het Nederlands'
    //     ],
    // ]);
    // shunday malumotni yozayotganda kril alifbosini
    //{"uz":"\u041d\u0430\u0436\u043c\u0438\u0434\u0434\u0438\u043d in English","ru":"Naam in het Nederlands"}
    // shunday bop qolishini oldini oladi va
    //{"uz":"Нажмиддин in English","ru":"Naam in het Nederlands"}
    //chiroyli qilib shunday yozib beradi
    /**
     * Encode the given value as JSON.
     *
     * @param  mixed  $value
     * @return string
     */
    protected function asJson($value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
