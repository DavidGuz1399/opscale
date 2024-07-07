<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request['password']       = Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);

        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $response = ['token' => $token];

        return response($response, 200);
    }
    public function authentication(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard()->attempt($credentials)) {
            return redirect()->intended();
        }

        return response($response, 200);
    }
}
