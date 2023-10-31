<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $credentials = $request->validated();
        UserService::createUser($credentials);

        return response()->json();
    }
}
