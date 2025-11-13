<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::with('user')->latest()->get();

        return view('admin.transaction.withdraw', compact('withdraws'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'amount' => 'required|numeric|min:1',
    //         'address' => 'required|string',
    //     ]);

    //     // Apply 5% fee
    //     $fee = $request->amount * 0.05;

    //     // $5 fixed fee for withdrawals under $100
    //     if ($request->amount < 100) {
    //         $fee += 5;
    //     }

    //     Withdraw::create([
    //         'user_id' => $request->user_id,
    //         'amount' => $request->amount,
    //         'withdrawal_fee' => $fee,
    //         'address' => $request->address,
    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Withdrawal request created successfully!');
    // }

    public function updateStatus(Request $request, Withdraw $withdraw)
{
    $withdraw->update([
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Withdraw status updated!');
}

}
