<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public static function login(array $credentials): bool
    {
        $users = json_decode(file_get_contents(database_path('users.json')), true);
        foreach ($users as $user) {
            if ($user['login'] == $credentials['login'] && Hash::check($credentials['password'], $user['password'])) {
                Cookie::queue('isAdmin', true);

                return true;
            }
        }

        return false;
    }
}
