<?php

namespace App\Http\Requests;


use App\User;

class UserLoginRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'phone' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}
