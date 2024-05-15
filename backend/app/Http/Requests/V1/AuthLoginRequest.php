<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseApiFormRequest;

class AuthLoginRequest extends BaseApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255',
        ];
    }
}
