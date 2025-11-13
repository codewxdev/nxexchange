<?php

namespace App\Http\Controllers;
use App\Models\Deposit;

use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index(){
        $deposits = Deposit::with('user')->latest()->get();
        return view('admin.transaction.deposit', compact('deposits'));
    }
    //  public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'amount' => 'required|numeric|min:1',
    //         'payment_gateway' => 'required|string',
    //         'transaction_id' => 'nullable|string',
    //     ]);

    //     $deposit = Deposit::create([
    //         'user_id' => $request->user_id,
    //         'amount' => $request->amount,
    //         'payment_gateway' => $request->payment_gateway,
    //         'transaction_id' => $request->transaction_id,
    //         'status' => 'pending',
    //     ]);

    //     return back()->with('success', 'Deposit request created successfully!');
    // }
  public function updateStatus(Request $request, Deposit $deposit)
{
    $deposit->update([
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Deposit status updated!');
}



}
