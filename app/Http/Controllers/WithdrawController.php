<?php

namespace App\Http\Controllers;

use App\Helpers\Notify;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = Withdraw::with('user')->latest()->get();

        return view('admin.transaction.withdraw', compact('withdraws'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:20',
            'address' => 'required|string',
        ]);

        $user = auth()->user();

        if ($user->balance < $request->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        $fee = $request->amount * 0.03;
        $net = $request->amount - $fee;

        // Deduct wallet balance
        $user->balance -= $request->amount;
        $user->save();

        // Create withdrawal entry
     $withdraw =   Withdraw::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'amount' => $request->amount,
            'fee' => $fee,
            'net_amount' => $net,
            'address' => $request->address,
            'transaction_id' => strtoupper(Str::random(12)),
            'status' => 'pending',
        ]);
           Notify::send(
            $user->id,
            'Withdrawal in Pending',
            "Your withdrawal request of $".$withdraw->amount." has been approved and is now being processed.",
            'info'
        );
        
        return back()->with('success', 'Your withdrawal request is now pending for approval.');
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

    //     public function updateStatus(Request $request, Withdraw $withdraw)
    // {
    //     $withdraw->update([
    //         'status' => $request->status,
    //         'approved_at' => $request->status === 'approved' ? now() : null,
    //         'approved_by_admin_id' => $request->status === 'approved' ? auth()->id() : null,

    //     ]);

    //     return redirect()->back()->with('success', 'Withdraw status updated!');
    //     Notify::send(auth()->user()->id,'Withdraw Pending','Your withdrawal request is now pending for approval.','success');
    // }

    public function updateStatus(Request $request, Withdraw $withdraw)
{
    $user = $withdraw->user; // Withdraw ka owner

    // Update withdraw status and admin info if approved
    $withdraw->update([
        'status' => $request->status,
        'approved_at' => $request->status === 'approved' ? now() : null,
        'approved_by_admin_id' => $request->status === 'approved' ? auth()->id() : null,
    ]);

    // Notification logic based on status
    if ($request->status === 'approved') {
        Notify::send(
            $user->id,
            'Withdrawal Approved',
            "Your withdrawal request of $".$withdraw->amount." has been approved and is now being processed.",
            'info'
        );

    } elseif ($request->status === 'completed') {
        Notify::send(
            $user->id,
            'Withdrawal Completed',
            "Your withdrawal request of $".$withdraw->amount." has been successfully completed.",
            'success'
        );

    } elseif ($request->status === 'rejected') {
        // Refund amount to user wallet
        $user->balance += $withdraw->amount;
        $user->save();

        Notify::send(
            $user->id,
            'Withdrawal Rejected',
            "Your withdrawal request of $".$withdraw->amount." has been rejected and the amount refunded to your wallet.",
            'error'
        );
    }

    return redirect()->back()->with('success', 'Withdraw status updated successfully!');
}


//     public function update(Request $request, $id)
//     {
//         $withdraw = Withdraw::findOrFail($id);

//         $withdraw->status = $request->status;

//         // If admin rejects then refund the amount
//         if ($request->status === 'rejected') {
//             $user = User::find($withdraw->user_id);
//             $user->balance += $withdraw->amount;
//             $user->save();
//         }

//         // If admin marks as completed then do nothing

//         $withdraw->save();
//          Notify::send(auth()->user()->id,'Withdraw Pending','Your withdrawal request is now pending for approval.','success');

//         return back()->with('success', 'Withdrawal status updated successfully.');
//     }
}
