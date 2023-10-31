<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function login(UserRequest $request)
    {
        $credentials = $request->validated();

        return response()->json(['success' => AuthService::login($credentials)]);
    }
}
