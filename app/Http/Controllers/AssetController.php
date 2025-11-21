<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = Auth::id();
        $wallet = Wallet::where('user_id', $userId)->first();
        return view('assets', compact('wallet'));
    }
}
