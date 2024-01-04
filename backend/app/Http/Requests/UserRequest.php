<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function store()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'password' => 'required|min:8|max:50',
            // 'password_confirmation' => 'required|same:password',
            'password' => ['required', 'string', 'min:8','max:40', 'confirmed'],
            'password_confirmation' => ['nullable', 'string', 'min:8','max:40', 'same:password'],
        ];
    }

    public function update()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|min:8|max:50',
            'password_confirmation' => 'required|same:password',
        ];
    }
}
