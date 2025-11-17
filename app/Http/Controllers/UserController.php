<?php

namespace App\Http\Controllers;

use App\Helpers\Referal;
use App\Models\Invitation;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return view('admin.user', compact('users'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function shareIndex()
    {

        $user = auth()->user();
        $invitation = Invitation::where('created_by', auth()->id())->first();

        $total_referrals = User::where('referred_by', $user->id)->count();
      
        // $uses = $invitation->uses;

        // Generate referral link
        $referral_link = url('/register?ref=' . $user->referral_code);
        return view('share', [
            'user' => $user,
            'referral_link' => $referral_link,
            'total_referrals' => $total_referrals,
        ]);
    }
}
