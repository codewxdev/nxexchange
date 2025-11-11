<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterController extends Controller
{
    // 
    function ShowRegister()
    {
        return view('Auth/register');
    }

    function storeRegisterForm(Request $request)
    {

        dd($request->all());
        $request->validate([ 
            'email' => 'required|email|unique:users,email',
            'code' => 'required|numeric',
            'password' => [
                'required',
                'confirmed',
                RulesPassword::min(8)      // Minimum 8 characters
                    ->mixedCase()          // At least one uppercase & one lowercase
                    ->letters()            // At least one letter
                    ->numbers()            // At least one number
                    ->symbols()            // At least one special character
            ],
        ]);

        // Match code with session
        if (
            $request->code != Session::get('verification_code') ||
            $request->email != Session::get('verification_email')
        ) {
            return back()->withErrors(['code' => 'Invalid verification code.']);
        }


        // Create new user
        $user = User::create([
            'name' => 'javed',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Auto-login and remember if requested
        $remember = $request->has('remember');

        // regenerate session id to prevent fixation
        $request->session()->regenerate();

        // Clear code after success
        Session::forget(['verification_code', 'verification_email']);

        return redirect('/')->with('success', 'Registration successful!');
    }



    public function sendCode(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $code = rand(100000, 999999); // 6-digit random code

        // Store code in session
        Session::put('verification_code', $code);
        Session::put('verification_email', $request->email);

        // Send mail
        Mail::raw("Your verification code is: {$code}", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Email Verification Code');
        });

        return response()->json(['success' => true, 'message' => 'Verification code sent successfully!']);
    }
}
