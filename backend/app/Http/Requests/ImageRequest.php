<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'category_id' => 'required|integer',
            // 'name.uz' => 'nullable|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'images.*' => 'required|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function update()
    {
        return [
            'category_id' => 'required|integer',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            // 'images.*' => 'nullable|mimes:jpeg,png,jpg,gif',
            'status' => 'required|integer',
        ];
    }
}
