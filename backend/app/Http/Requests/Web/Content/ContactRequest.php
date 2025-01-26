<?php

namespace App\Http\Requests\Web\Content;

use App\Http\Requests\BaseFormRequest;

class ContactRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'contact_subject_id' => 'require|integer',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'body' => 'required|string|max:65000',
        ];
    }

    public function update()
    {
        return [
            'status' => 'required|integer',
        ];
    }
}
