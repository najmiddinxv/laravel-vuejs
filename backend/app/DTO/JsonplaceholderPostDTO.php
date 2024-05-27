<?php

namespace App\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\ArrayType;

class JsonplaceholderPostDTO extends Data
{
    public function __construct(
        #[Required, StringType, Max(1000)]
        public string $title,
        
        #[Nullable, StringType, Max(65000)]
        public ?string $body,
    ) {
    }

}
