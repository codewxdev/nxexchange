<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        // Default EN if no session
        $lang = session('locale', 'en');

        // Tell Laravel about current language
        App::setLocale($lang);

        return $next($request);
    }
}
