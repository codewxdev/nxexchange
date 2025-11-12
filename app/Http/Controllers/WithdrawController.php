<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index(){
        return view('admin.transaction.withdraw');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
            'address' => 'required|string',
        ]);

        // Apply 5% fee
        $fee = $request->amount * 0.05;

        // $5 fixed fee for withdrawals under $100
        if ($request->amount < 100) {
            $fee += 5;
        }

        Withdrawal::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'withdrawal_fee' => $fee,
            'address' => $request->address,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Withdrawal request created successfully!');
    }

}
