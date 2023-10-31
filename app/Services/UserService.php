<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function createUser(array $credentials): void
    {
        $users = json_decode(file_get_contents(database_path('users.json')), true);
        $credentials['password'] = Hash::make($credentials['password']);
        $users[] = $credentials;
        file_put_contents(database_path('users.json'), json_encode($users));
    }
}
