<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends BaseApiFormRequest
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
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4,video/mpeg,video/x-matroska',

            // 'original_name' => 'nullable|string|max:255',
            // 'disk' => 'nullable|string|max:255',
            // 'path' => 'nullable|string|max:255',
            // 'converted_for_downloading_at' => 'datetime|string|max:255',
            // 'converted_for_streaming_at' => 'datetime|string|max:255',
        ];
    }

    public function update()
    {
        return [

        ];
    }
}
