<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function ShowLogin()
    {
        return view('Auth/login');
    }

    public function StoreLoginForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        // Laravel logout
        Auth::logout();

        // Session invalidate & token regenerate (security best practice)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect after logout
        return redirect()->route('login.index')->with('status', 'You have been logged out successfully.');
    }
}
