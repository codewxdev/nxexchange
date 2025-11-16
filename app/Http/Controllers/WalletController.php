<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function store(Request $request)
    {
        // $request->validate([
        //     'address' => 'required|string|max:255'
        // ]);

        // auth()->user()->update([
        //     'wallet_address' => $request->address
        // ]);

        // return back()->with('success', 'Wallet address saved!');
    }


    public function transaction() {
        return view('transactions');
    }
}
