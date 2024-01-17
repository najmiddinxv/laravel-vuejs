<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function store()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',

            'birth_date' => 'required|date',
            'sex' => 'required|integer',
            'email' => 'nullable|string',

            'position' => 'nullable|integer',


            'password' => 'required|string|max:255',
            'bank_branch_id' => "required|integer",
            'phone' => "required|string",
            'role_id' => "required|integer",
            // 'is_active' => "required|integer",
            'avatar' => "nullable|mimes:jpg,jpeg,png|max:10240",
            'file' => "nullable|mimes:doc,docx,pdf",

        ];
    }

    public function update()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',

            'birth_date' => 'required|date',
            'sex' => 'required|integer',
            'email' => 'nullable|string',

            'position' => 'nullable|integer',


            'password' => 'nullable|string|max:255',
            'bank_branch_id' => "required|integer",
            'phone' => "required|string",
            'role_id' => "required|integer",
            // 'is_active' => "required|integer",
            'avatar' => "nullable|mimes:jpg,jpeg,png|max:10240",
            'file' => "nullable|mimes:doc,docx,pdf",
            'is_active' => "nullable|integer",

            'permission_ids' => 'nullable|array',
            'role_ids' => 'nullable|array',
        ];
    }
}
