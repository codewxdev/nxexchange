<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->account_status === 'deactivated') {
                auth()->logout();

                return redirect()->route('login.index')->withErrors([
                    'email' => 'Your account has been deactivated. Please contact support.',
                ]);
            }

        }

        return $next($request);
    }
}
