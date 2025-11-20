<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::with('user')->latest()->get();

        return view('admin.transaction.transfer', compact('transfers'));
    }

    public function processTransfer(Request $request)
    {
        $request->validate([
            'from_account' => 'required|in:trade,exchange',
            'to_account' => 'required|in:trade,exchange',
            'amount' => 'required|numeric|min:0.01',
        ]);

        if ($request->from_account === $request->to_account) {
            return redirect()->back()->with('error', 'Source and destination wallet cannot be same!');
        }

        try {
            $result = DB::transaction(function () use ($request) {
                $user = auth()->user();

                $wallet = Wallet::where('user_id', $user->id)->lockForUpdate()->first();

                if (! $wallet) {
                    return ['error' => 'no_wallet'];
                }

                $fromBalance = $wallet->{$request->from_account.'_balance'};
                $requestAmount = (float) $request->amount;

                if ($requestAmount > $fromBalance) {
                    return ['error' => 'insufficient'];
                }

                // Get volume
                $volumeData = $user->getTradingVolumeData();
                $transferData = $this->calculateTransferWithDeduction(
                    $request->from_account,
                    $request->to_account,
                    $requestAmount,
                    $volumeData
                );

                // Update balances
                $wallet->decrement($request->from_account.'_balance', $requestAmount);
                $wallet->increment($request->to_account.'_balance', $transferData['net_amount']);
                $wallet->refresh();

                // Log transaction
                WalletTransaction::create([
                    'user_id' => $user->id,
                    'type' => 'transfer',
                    'from_wallet' => $request->from_account,
                    'to_wallet' => $request->to_account,
                    'amount' => $transferData['net_amount'],
                    'status' => 'completed',
                    'remark' => $transferData['deduction_applied']
                        ? "20% deduction applied. Original: {$requestAmount}, Received: {$transferData['net_amount']}"
                        : "Transfer from {$request->from_account} to {$request->to_account}",
                ]);

                // Save transfer
                Transfer::create([
                    'user_id' => $user->id,
                    'from_account' => $request->from_account,
                    'to_account' => $request->to_account,
                    'amount' => $requestAmount,
                    'deduction' => $transferData['deduction_amount'],
                    'status' => 'completed',
                    'date_time' => now(),
                    'deduction_applied' => $transferData['deduction_applied'],
                    'deduction_amount' => $transferData['deduction_amount'],
                    'net_amount' => $transferData['net_amount'],
                    'trading_volume_at_transfer' => $volumeData['target_volume'],
                    'trading_volume_completed_at_transfer' => $volumeData['completed_volume'],
                    'trading_volume_status' => $volumeData['progress_percentage'] >= 100 ? 'completed' : 'incomplete',
                ]);

                return [
                    'success' => true,
                    'transfer_data' => $transferData,
                    'current_balances' => [
                        'trade_balance' => $wallet->trade_balance,
                        'exchange_balance' => $wallet->exchange_balance,
                    ],
                ];
            });

            // FAILURE HANDLERS
            if (isset($result['error'])) {
                if ($result['error'] === 'no_wallet') {
                    return redirect()->back()->with('error', 'Wallet not found!');
                }

                if ($result['error'] === 'insufficient') {
                    return redirect()->back()->with('error', 'Insufficient balance!');
                }
            }

            // SUCCESS - With detailed message
            $message = $result['transfer_data']['deduction_applied']
                ? "Transfer completed! {$result['transfer_data']['deduction_amount']} deduction applied. Net received: {$result['transfer_data']['net_amount']}"
                : 'Transfer completed successfully!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Transfer failed: '.$e->getMessage());
        }
    }

    private function calculateTransferWithDeduction($fromAccount, $toAccount, $amount, $volumeData)
    {
        // Simple float conversion - database will handle precision
        $amount = (float) $amount;

        // Apply deduction ONLY for trade → exchange transfer with incomplete volume
        if ($fromAccount === 'trade' && $toAccount === 'exchange' && $volumeData['progress_percentage'] < 100) {
            $deductionAmount = $amount * 0.20;
            $netAmount = $amount - $deductionAmount;

            return [
                'deduction_applied' => true,
                'deduction_amount' => $deductionAmount,
                'net_amount' => $netAmount,
                'volume_completion' => $volumeData['progress_percentage'],
                'message' => '20% deduction applied due to incomplete trading volume',
            ];
        }

        // No deduction for other cases
        return [
            'deduction_applied' => false,
            'deduction_amount' => 0,
            'net_amount' => $amount,
            'volume_completion' => $volumeData['progress_percentage'],
            'message' => 'Transfer completed successfully',
        ];
    }
}
