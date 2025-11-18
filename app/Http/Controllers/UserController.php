<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $referral_link = url('/register?ref='.$user->referral_code);

        return view('share', [
            'user' => $user,
            'referral_link' => $referral_link,
            'total_referrals' => $total_referrals,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'level' => 'required|integer|between:0,6',
            'account_status' => 'required|in:active,locked,deactivated',
            'kyc_status' => 'required|in:verified,not_verified,pending,rejected',
        ]);

        $user = User::findOrFail($request->user_id);

        if ($request->account_status === 'deactivated' && $user->account_status !== 'deactivated') {
            DB::table('sessions')
                ->where('user_id', $user->id)
                ->delete();

        }

        $user->update([
            'level' => $request->level,
            'account_status' => $request->account_status,
            'kyc_status' => $request->kyc_status,
        ]);

        return redirect()->back()->with('success', 'User updated successfully!');
    }

    // Controller
    // UserController.php
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete(); // یہ soft delete ہوگا

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: '.$e->getMessage(),
            ], 500);
        }
    }
}
