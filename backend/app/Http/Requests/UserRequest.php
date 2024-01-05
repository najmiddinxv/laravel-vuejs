<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
class UserRequest extends BaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function store()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:255',
            'userAvatar' => 'nullable|image|mimes:jpeg,png,jpg|max:8192',
            'password' => ['required', 'string', 'min:8','max:40', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8','max:40', 'same:password'],

            // 'image' => 'required|image|size:1024||dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            // 'image' => 'required|image|size:1024|dimensions:ratio=3/2'

            // 'avatar' => [
            //     'required',
            //     Rule::dimensions()->maxWidth(1000)->ratio(3/2),
            // ],

            // 'password' => 'required|min:8|max:50',
            // 'password_confirmation' => 'required|same:password',

            // 'username' => [
            //     'required',
            //     'string',
            //     'max:255',
            //     Rule::unique('users')->ignore($this->id),
            // ],

            // 'date' => [
            //     'required',
            //     'unique:expenses,date',
            //     Rule::unique('expenses', 'date')->where('user_id', $this->input('user_id')),
            // ],

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
