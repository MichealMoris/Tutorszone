<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authorized
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->permission == "admin" || Auth::user()->permission == "superadmin")) {
            return $next($request);
        }

        return redirect('/'); // Redirect to homepage or any other route
    }
}
