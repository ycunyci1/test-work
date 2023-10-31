<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthByJson
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! Cookie::get('isAdmin')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
