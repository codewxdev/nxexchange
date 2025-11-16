<?php

namespace App\Http\Controllers;

use App\Helpers\Notify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function index(){
        return view('kyc.index');
    }

    public function store(Request $request)
{
    $user = User::find(Auth::user()->id);

    // Validate inputs
    $request->validate([
        'country'     => 'required|string|max:100',
        'cnic'        => 'required|string|max:50',

        // Only JPG, JPEG, PNG — Max 2MB (2048 KB)
        'cnic_front'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'cnic_back'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    //Generate unique names for files
    $frontName = time() . '_front_' . uniqid() . '.' . $request->file('cnic_front')->getClientOriginalExtension();
    $backName  = time() . '_back_'  . uniqid() . '.' . $request->file('cnic_back')->getClientOriginalExtension();

    // Storage paths
    $frontPath = public_path('kyc/');
    $backPath  = public_path('kyc/');

    // Create folder if not exist
    if (!file_exists($frontPath)) {
        mkdir($frontPath, 0777, true);
    }

    // Move files to public/uploads/kyc
    $request->file('cnic_front')->move($frontPath, $frontName);
    $request->file('cnic_back')->move($backPath, $backName);

    // Update user information
    $user->update([
        'country'   => $request->country,
        'id_card_number'      => $request->cnic,
        'kyc_front_image' => $frontName,   // Only filename stored
        'kyc_back_image'  => $backName,    // Only filename stored
        'kyc_status'    => 'pending',
    ]);

    Notify::send($user->id, "Thanks for Submition", "Your identity verification is under review.", "info");
    return redirect()->route('home')->with('success', 'documents submitted successfully!');
}

}
