<?php

namespace App\Http\Requests\V1;

use App\Http\Requests\BaseApiFormRequest;

class AuthRegisterRequest extends BaseApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            
        ];
    }
}
