<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Faker\Provider\Base;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
class BaseApiFormRequest extends FormRequest
{
    public function rules()
    {
        return match($this->method()){
            'POST' => $this->store(),
            'PUT', 'PATCH' => $this->update(),
            // 'DELETE' => $this->destroy(),
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

    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson())
        {
            $response = response()->json([
                'success' => false,
                'message' => 'Ops! Some errors occurred',
                'errors' => $validator->errors()
            ]);
        }else{
            $response = back()->with('error', __('locale.ops'))->withErrors($validator)->withInput();
        }

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
