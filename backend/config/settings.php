<?php

return [
    'main_locale'       => 'ru',
    'available_locales' => ['ru', 'uz', 'en'],
    'default'           =>//request default value
    [
        "list_type"   => 'paginate',//paginate,collection
        "limit"       => 30,
        "per_page"    => 30,
        "order_by"    => 'id',
        "sort_by"     => 'desc',
        'date_format' => 'Y-m-d H:i',
    ],
    
];
