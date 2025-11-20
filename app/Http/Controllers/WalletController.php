<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'address' => 'required|string|max:255'
    //     ]);

    //     auth()->user()->update([
    //         'address' => $request->address
    //     ]);

    //     return back()->with('success', 'Wallet address successfully updated!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:255',
    ]);

    $user = auth()->user();

    // Check if address already exists
    if ($user->address) {
        // ----- UPDATE LOGIC -----
        $user->update([
            'address' => $request->address,
        ]);

        return back()->with('success', 'Wallet address updated successfully!');
    } else {
        // ----- CREATE LOGIC -----
        $user->update([
            'address' => $request->address,
        ]);

        return back()->with('success', 'Wallet address saved successfully!');
    }
}

    public function transaction()
    {
        return view('transactions');
    }

    public function history()
    {
        try {
            $wallets = Wallet::with(['user'])->get();
              
            return view('admin.wallet', compact('wallets'));

        } catch (\Exception $e) {
            return back()->with('error', 'Error loading trades: '.$e->getMessage());
        }
    }

    public function wallet_history()
    {
        $wallets = WalletTransaction::get();

        return view('admin.wallet_history', compact('wallets'));
    }

    public function destroy(Request $request, $id)
    {
        $wallet = WalletTransaction::find($request->id);
        $wallet->delete();

        return back()->with('success', 'Wallet transaction deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:deposit,withdrawal,transfer,admin_adjustment',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|in:pending,completed,failed',
            'remark' => 'nullable|string|max:500',
        ]);

        $transaction = WalletTransaction::findOrFail($id);
        $user_id = $transaction->user_id;

        DB::transaction(function () use ($transaction, $request, $user_id) {
            // Get user's wallet
            $wallet = Wallet::where('user_id', $user_id)->first();

            if (! $wallet) {
                throw new \Exception('User wallet not found');
            }

            $oldExchangeBalance = $wallet->exchange_balance;

            // Deposit logic - ADD amount to exchange_balance
            if ($request->type === 'deposit') {
                $wallet->exchange_balance += $request->amount;
            }
            // Withdrawal logic - DEDUCT amount from exchange_balance
            elseif ($request->type === 'withdrawal') {
                // Check if sufficient balance available
                if ($wallet->exchange_balance < $request->amount) {
                    throw new \Exception('Insufficient balance. Available: '.$oldExchangeBalance);
                }
                $wallet->exchange_balance -= $request->amount;
            }

            // Save wallet changes
            $wallet->save();

            // Update transaction record
            $transaction->update([
                'type' => $request->type,
                'amount' => $request->amount,
                'status' => $request->status,
                'remark' => $request->remark,
            ]);
        });

        return redirect()->back()->with('success', 'Transaction updated successfully!');
    }
}
