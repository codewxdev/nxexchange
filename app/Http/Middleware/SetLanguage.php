<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
     public function handle(Request $request, Closure $next)
    {
        // session me language hai?
        $lang = session('locale', 'en'); // default en
        App::setLocale($lang);

        return $next($request);
    }
}
