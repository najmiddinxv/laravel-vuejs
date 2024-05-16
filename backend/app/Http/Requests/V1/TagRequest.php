<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseApiFormRequest;

class TagRequest extends BaseApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'tagsable_type' => 'nullable|string|max:255',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
        ];
    }

    public function update()
    {
        return [
            'tagsable_type' => 'nullable|string|max:255',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
        ];
    }
}
