<?php

namespace App\DTO;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\IntegerType;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Attributes\Validation\MimeTypes;

class PostDTO extends Data
{
    public function __construct(
        #[Required, IntegerType]
        public int $categoryId,

        #[ArrayType, Nullable, StringType, Max(1000)]
        public ?array $title = null,

        #[ArrayType, Nullable, StringType, Max(1000)]
        public ?array $description = null,

        #[ArrayType, Nullable, StringType, Max(65000)]
        public ?array $body = null,

        #[Nullable, Image, MimeTypes(['jpeg', 'png', 'jpg', 'gif']), Max(4096)]
        public ?string $image = null,

        #[Nullable, IntegerType]
        public ?int $status,

        #[Nullable, IntegerType]
        public ?int $slider,

        #[ArrayType, Nullable, IntegerType]
        public ?array $tags = null
    ) {}

}

