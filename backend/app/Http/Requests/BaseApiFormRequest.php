<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Faker\Provider\Base;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseApiFormRequest extends FormRequest
{
    public function rules()
    {
        return match($this->method()){
            'POST' => $this->store(),
            'PUT', 'PATCH' => $this->update(),
            'DELETE' => $this->destroy(),
            'GET','HEAD' => $this->view()
            // default => $this->view()
        };

    }

    public function view()
    {
        return [];
    }

    public function store()
    {
        return [];
    }

    public function update()
    {
        return [];
    }

    public function destroy()
    {
        return [];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success' => false,
            'code' => 422,
            'message' =>$validator->errors(),
            'data' => [],
        ], 422));

    }

}
