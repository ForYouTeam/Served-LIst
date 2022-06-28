<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|min:5|max:100|unique:users,username',
            'password' => 'required|min:5|max:50|confirmed'
        ];
    }
}
