<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TinymceFileRequest extends BaseFormRequest
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
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'description.*' => ['nullable','string','max:255'],
            'files.*' => 'required|mimes:jpeg,png,jpg,gif,doc,docx,xls,xlsx,txt,mp4,pdf,mp3|max:102400',
        ];
    }

    public function update()
    {
        return [
            'category_id' => 'nullable|integer',
            'name.uz' => 'required|string|max:255',
            'name.*' => ['nullable','string','max:255'],
            'description.*' => ['nullable','string','max:255'],
            // 'files.*' => 'nullable|mimes:jpeg,png,jpg,gif,doc,docx,xls,xlsx,txt,mp4,pdf,mp3|max:102400',
            'status' => 'nullable|integer',
        ];
    }
}
