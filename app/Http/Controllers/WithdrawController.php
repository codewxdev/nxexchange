<?php

namespace App\Http\Controllers;

use App\Helpers\Notify;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WithdrawController extends Controller
{
    public function index(Request $request)
    {
        $query = Withdraw::with('user')->latest();

        // Status filter
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // From date filter
        if ($request->has('from_date') && $request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        // To date filter
        if ($request->has('to_date') && $request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $withdraws = $query->get();

        // Statistics - Apply same filters for accurate stats
        $statsQuery = Withdraw::query();

        if ($request->has('status') && $request->status != 'all') {
            $statsQuery->where('status', $request->status);
        }
        if ($request->has('from_date') && $request->from_date) {
            $statsQuery->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->has('to_date') && $request->to_date) {
            $statsQuery->whereDate('created_at', '<=', $request->to_date);
        }

        $totalWithdrawals = $statsQuery->count();
        $totalAmount = $statsQuery->sum('amount');
        $totalFees = $statsQuery->sum('withdrawal_fee');
        $pendingWithdrawals = $statsQuery->where('status', 'pending')->count();

        return view('admin.transaction.withdraw', compact(
            'withdraws',
            'totalWithdrawals',
            'totalAmount',
            'totalFees',
            'pendingWithdrawals'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:20',
        ]);

        $user = auth()->user();
        $wallet = Wallet::where('user_id', auth()->id())->first();

        if ($wallet->exchange_balance + $wallet->trade_balance < $request->amount) {
            return back()->with('error', 'Insufficient balance.');
        }

        $fee = $request->amount * 0.05;
        $net = $request->amount - $fee;

        // Deduct wallet balance
        $wallet->exchange_balance -= $request->amount;
        $wallet->save();
        $user->save();

        // Create withdrawal entry
        $withdraw = Withdraw::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'amount' => $request->amount,
            'fee' => $fee,
            'net_amount' => $net,
            'transaction_id' => strtoupper(Str::random(12)),
            'status' => 'pending',
            'address' => auth()->user()->address,
        ]);
        Notify::send(
            $user->id,
            'Withdrawal in Pending',
            'Your withdrawal request of $'.$withdraw->amount.' has been approved and is now being processed.',
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

        $user = $withdraw->exchange_balance;
        // Update withdraw status and admin info if approved
        $withdraw->update([
            'status' => $request->status,
            'approved_at' => $request->status === 'approved' ? now() : null,
            'approved_by_admin_id' => $request->status === 'approved' ? auth()->id() : null,
        ]);

        // Notification logic based on status
        if ($request->status === 'approved') {
            $user->exchange += $withdraw->amount;
            $user->save();
            Notify::send(
                $user->id,
                'Withdrawal Approved',
                'Your withdrawal request of $'.$withdraw->amount.' has been approved and is now being processed.',
                'info'
            );

        } elseif ($request->status === 'completed') {
            Notify::send(
                $user->id,
                'Withdrawal Completed',
                'Your withdrawal request of $'.$withdraw->amount.' has been successfully completed.',
                'success'
            );

        } elseif ($request->status === 'rejected') {
            // Refund amount to user wallet
            $user->balance += $withdraw->amount;
            $user->save();

            Notify::send(
                $user->id,
                'Withdrawal Rejected',
                'Your withdrawal request of $'.$withdraw->amount.' has been rejected and the amount refunded to your wallet.',
                'error'
            );
        }

        return redirect()->back()->with('success', 'Withdraw status updated successfully!');
    }
}
