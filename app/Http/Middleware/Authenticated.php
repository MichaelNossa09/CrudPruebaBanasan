<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticated
{

    public function handle($request, Closure $next)
    {
        if (Auth::check() || $request->is('home')) {
            return $next($request);
        }

        return redirect('/home');
    }
}
