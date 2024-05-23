<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class JsonplaceholderPostDTO extends Data
{
    public function __construct(
        public ?string $userId,
        public string $title,
        public string $body,
    ) {
    }

}

