<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseApiFormRequest;

class PostRequest extends BaseApiFormRequest
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
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer',
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
            'tags' => 'nullable|array',
            'tags.*' => 'integer',
        ];
    }


    public function view()
    {
        return [
            'title' => 'nullable|string|max:255',
            // 'sort_by_title' => 'nullable|string|max:255',
            'view_count' => 'nullable|in:asc,desc',
            // 'created_at' => 'nullable|in:asc,desc',
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

}
