<?php

namespace App\Http\Requests\Web;

use App\Http\Requests\BaseFormRequest;

class CommentRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'body' => 'required|string|max:65000',
        ];
    }

    // public function update()
    // {
    //     return [
    //         // 'parent_id' => 'nullable|integer',
    //         // 'body' => 'required|string|max:65000',
    //         'status' => 'nullable|integer',
    //     ];
    // }
}
