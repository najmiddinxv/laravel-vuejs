<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class TagEditResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name_uz' => $this->getTranslation('name', 'uz'),
            'name_ru' => $this->getTranslation('name', 'ru'),
            'name_en' => $this->getTranslation('name', 'en'),
            'tagsable_type' => $this->tagsable_type,
        ];
    }
}
