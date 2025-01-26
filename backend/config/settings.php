<?php

return [

    'jsonplaceholder_url' => env('JSONPLACEHOLDER', 'https://jsonplaceholder.typicode.com'),
    //yoki
    'jsonplaceholder_url' => 'https://jsonplaceholder.typicode.com',

    'main_locale'       => 'ru',
    'available_locales' => ['ru', 'uz', 'en'],

    'frontend_url' => 'http://127.0.0.1:8000',

    'paginate_per_page' => 20,
    'paginate' => 20,

    'large_image' => [
        'width' => 1900,
        'height' => 1080
    ],
    'medium_image'  => [
        'width' => 300,
        'height' => 170
    ],
    'small_image'  => [
        'width' => 100,
        'height' => 100
    ],
    'default'           => [
        "list_type"   => 'paginate',//paginate,collection
        "limit"       => 30,
        "per_page"    => 30,
        "order_by"    => 'id',
        "sort_by"     => 'desc',
        'date_format' => 'Y-m-d H:i',
    ],
];
