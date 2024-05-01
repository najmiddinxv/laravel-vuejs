<?php

namespace App\Http\Requests;

class PageRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'category_id' => 'required|integer',
            'title.uz' => 'required|string|max:1000',
            'title.*' => ['nullable','string','max:1000'],
            'description.*' => ['nullable','string','max:1000'],
            'body.uz' => 'required|string|max:65000',
            'body.*' => ['nullable','string','max:65000'],

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'status' => 'required|integer',
            'slider' => 'required|integer',
        ];
    }

    public function update()
    {
        return [
            'category_id' => 'required|integer',
            'title.uz' => 'required|string|max:1000',
            'title.*' => ['nullable','string','max:1000'],
            'description.*' => ['nullable','string','max:1000'],
            'body.uz' => 'required|string|max:65000',
            'body.*' => ['nullable','string','max:65000'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'status' => 'required|integer',
            'slider' => 'required|integer',
        ];
    }
}
