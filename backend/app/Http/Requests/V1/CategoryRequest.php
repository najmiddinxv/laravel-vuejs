<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseApiFormRequest;

class CategoryRequest extends BaseApiFormRequest
{
    public function authorize(): bool
    {
        return true;

    }

    public function view()
    {
        return [
            'name' => 'nullable|string|max:255',
            'order' => 'nullable|in:asc,desc',
            'per_page' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }

    public function store()
    {
        return [
            'parent_id' => 'nullable|integer',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'categoryable_type' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'order' => 'nullable|integer',
            // 'status' => 'nullable|integer',
        ];
    }

    public function update()
    {
        return [
            'parent_id' => 'nullable|integer',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'categoryable_type' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'order' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }
}
