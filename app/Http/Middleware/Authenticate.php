<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResourceUnauthorized;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        $responseArray = [
            'error' => [
                'code' => 401,
                'message' => 'Unauthorized'
            ]
        ];

        throw new HttpResponseException(response($responseArray, 401));
    }
}
