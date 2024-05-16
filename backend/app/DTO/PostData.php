<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        public string $title,
        public ?string $description,
    ) {
    }

    // https://spatie.be/docs/laravel-data/v4/as-a-data-transfer-object/creating-a-data-object

}

