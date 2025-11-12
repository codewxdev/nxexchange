<?php

namespace App\Http\Controllers;
use App\Models\Transfer;

use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index(){
        $transfers = Transfer::with('user')->latest()->get();
        return view('admin.transaction.transfer', compact('transfers'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'from_account' => 'required|in:exchange,trade',
            'to_account' => 'required|in:exchange,trade|different:from_account',
            'amount' => 'required|numeric|min:1',
        ]);

        // Apply 20% deduction logic (if volume incomplete)
        // for now we simulate it — in real logic you'd check trade volume
        $deduction = $request->has('volume_incomplete') ? $request->amount * 0.20 : 0;

        Transfer::create([
            'user_id' => $request->user_id,
            'from_account' => $request->from_account,
            'to_account' => $request->to_account,
            'amount' => $request->amount,
            'deduction' => $deduction,
            'status' => 'completed',
        ]);

        return back()->with('success', 'Transfer recorded successfully!');
    }
}
