<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'category_id' => 'required|integer',

            'title.uz' => 'required|string|max:255',
            'title.*' => ['nullable','string','max:255'],
            'description.*' => ['nullable','string','max:500'],
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
            'title.uz' => 'required|string|max:255',
            'title.*' => ['nullable','string','max:255'],
            'description.*' => ['nullable','string','max:500'],
            'body.uz' => 'required|string|max:65000',
            'body.*' => ['nullable','string','max:65000'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'status' => 'required|integer',
            'slider' => 'required|integer',
        ];
    }
}
