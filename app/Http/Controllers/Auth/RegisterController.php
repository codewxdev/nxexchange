<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Referal;
use App\Http\Controllers\Controller;
use App\Models\Invitation;
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
        return view('Auth.register');
    }

    function storeRegisterForm(Request $request)
    {


        $errors = $request->validate([
            'email' => 'required|email|unique:users,email',
            'code' => 'required|numeric',
            'invitation_code' => 'required|string',
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

        //referal algorithms 
        $invite = Invitation::where('code', $request->invitation_code)->first();
        
        // dd($invite);
        if (!$invite) {
            
            return back()->withErrors(['invitation_code' => 'Invalid invitation code'])->withInput();
        }

        if ($invite->single_use && $invite->uses >= 1) {
            return back()->withErrors(['invitation_code' => 'This invitation is already used'])->withInput();
        }
        if ($invite->max_uses && $invite->uses >= $invite->max_uses) {
            return back()->withErrors(['invitation_code' => 'Invitation usage limit reached'])->withInput();
        }

        $code = Referal::generateReferralCode(8);
        // Create new user
        $user = User::create([
            'name' => 'asim bahi',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $code,
            'referred_by' => $invite->created_by // may be null if admin-generated
        ]);

        // mark invite used
        $invite->increment('uses');

        // increment referrer count
        if ($invite->created_by) {
            User::where('id', $invite->created_by)->increment('referrals_count');
        }

        Invitation::create([
            'code' => $code,
            'created_by' => $user->id,
        ]);

        // Auto-login and remember if requested
        $remember = $request->has('remember');

        // regenerate session id to prevent fixation
        $request->session()->regenerate();

        // Clear code after success
        Session::forget(['verification_code', 'verification_email']);

        return redirect(route('login.index'))->with('success', 'Registration successful!');
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
