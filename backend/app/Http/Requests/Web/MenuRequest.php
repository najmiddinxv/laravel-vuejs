<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\BaseFormRequest;

class MenuRequest extends BaseFormRequest
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
            'parent_id' => 'nullable|integer',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'url.*' => 'nullable|string|max:255',
            'position' => 'nullable|integer',
            'menu_order' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }

    public function update()
    {
        return [
            'parent_id' => 'nullable|integer',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'url.*' => 'nullable|string|max:255',
            'position' => 'nullable|integer',
            'menu_order' => 'nullable|integer',
            'status' => 'nullable|integer',
        ];
    }
}
