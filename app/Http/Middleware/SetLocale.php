<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
{
    $locale = $request->segment(1);
    if (!in_array($locale, ['en', 'ar'])) {
        return redirect('/' . config('app.fallback_locale') . '/' . $request->path());
    }

    App::setLocale($locale);

    return $next($request);
}
}
