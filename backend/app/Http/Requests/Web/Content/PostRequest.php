<?php

namespace App\Http\Requests\Web\Content;

use App\Http\Requests\BaseFormRequest;

class PostRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
        // return false;// bu authentikatsiyadan o'tish kerakligini anglatadi
        // return true;// bu authentikatsiyadan o'tsin hoh o'tmasin ishlata oladi degani

    }

    public function store()
    {
        return [
            'category_id' => 'required|integer',
            // 'title' => 'required|string',
            // 'description' => 'nullable|string',
            // 'body' => 'nullable|string',

            'title.uz' => 'required|string|max:1000',
            'title.*' => ['nullable','string','max:1000'],
            'description.*' => ['nullable','string','max:1000'],
            'body.uz' => 'required|string',
            'body.*' => 'nullable|string',
            // 'body.uz' => 'required|string|max:65000',
            // 'body.*' => ['nullable','string','max:65000'],

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|integer',
            'slider' => 'required|integer',
            'tags' => 'nullable|array',
            'tags.*' => 'integer',
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
            'titleSortBy' => 'nullable|in:asc,desc',
            'createdAt' => 'nullable|in:asc,desc',
            'viewCount' => 'nullable|in:asc,desc',
            'listType' => 'nullable|in:pagination,collection',
            'perPage' => 'nullable|integer|max:100',
        ];
    }

}
