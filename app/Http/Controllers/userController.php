<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Resources\UserResourceToken;
use App\Http\Resources\UserShowResource;
use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class userController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return new UserShowResource($user);
    }

    public function register(UserRegistrationRequest $request)
    {
        User::create($request->all());
        return response(null, 204);
    }

    public function login(UserLoginRequest $request)
    {
        $user = User::where([
            'phone' => $request->get('phone'),
            'password' => $request->get('password')
        ])->first();

        if ($user === null) {
            $responseArray = [
                'error' => [
                    'code' => 401,
                    'message' => 'Unauthorized',
                    'errors' => [
                        'phone' => 'phone or password incorrect'
                    ]
                ]
            ];
            throw new HttpResponseException(response($responseArray, 401));
        }

        $user->api_token = Str::random(80);
        $user->save();

        return new UserResourceToken($user);
    }
}
