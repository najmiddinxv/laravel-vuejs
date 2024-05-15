<?php

namespace App\DTO;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class AddressData extends Data
{
    public function __construct(
        // #[Rule('required_with:district_id'), Exists('regions', 'id')]
        // public ?int $region_id,
        // #[Rule('required_with:region_id|integer')]
        public ?int $district_id,
        public string $address,
        #[Regex('/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/')]
        public float $long,
        #[Regex('/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/')]
        public float $lat,
    ) {
    }

    // public static function rules(): array
    // {
    //     return [
    //         'district_id' => [\Illuminate\Validation\Rule::exists('districts', 'id')
    //                               ->where('region_id', request('address.region_id'))],
    //     ];
    // }
}

