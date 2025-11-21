<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\UserNotification;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeApprovalController extends Controller
{
    public function pendingTrades()
    {
        $pendingTrades = Trade::with(['user', 'signal'])
            ->where('result', 'pending')
            ->latest()
            ->get();

        return view('admin.trade_pending', compact('pendingTrades'));
    }

    public function getTradeDetails($id)
    {
        $trade = Trade::with('user')->findOrFail($id);

        return response()->json([
            'id' => $trade->id,
            'user' => ['email' => $trade->user->email],
            'trade_type' => $trade->trade_type,
            'direction' => $trade->direction,
            'crypto_symbol' => $trade->crypto_symbol,
            'stake_amount' => $trade->stake_amount,
            'created_at' => $trade->created_at->format('M d, Y H:i:s'),
        ]);
    }

    public function approveTrade(Request $request)
    {
        $request->validate([
            'trade_id' => 'required|exists:trades,id',
            'result' => 'required|in:win,lose',
            'profit_rate' => 'required|numeric|min:70|max:85',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // dd($request->all());
                $trade = Trade::with('user')->findOrFail($request->trade_id);
           
                if ($request->result === 'win') {
                    $profitAmount = ($trade->stake_amount * $request->profit_rate) / 100;

                    $trade->update([
                        'result' => 'win',
                        'profit_rate' => $request->profit_rate,
                        'profit_amount' => $profitAmount,
                        'end_time' => now(),
                        'status' => 'confirm',
                    ]);
               
                    // Credit profit + stake back to user's wallet
                    $wallet = Wallet::where('user_id', $trade->user_id)->first();
                    if ($wallet) {
                        $totalReturn = $trade->stake_amount + $profitAmount;
                        $wallet->trade_balance += $totalReturn;
                        $wallet->save();
                    }
                    // Create win notification using your existing system
                    UserNotification::create([
                        'user_id' => $trade->user_id,
                        'title' => 'Trade Won! 🎉',
                        'message' => "Congratulations! Your {$trade->crypto_symbol} {$trade->direction} trade won with {$request->profit_rate}% profit. You earned $".number_format($profitAmount, 2).'!',
                        'type' => 'success',
                        'is_read' => false,
                    ]);

                } else {
                    $trade->update([
                        'result' => 'lose',
                        'profit_rate' => $request->profit_rate,
                        'profit_amount' => 0,
                        'end_time' => now(),
                        'status' => 'confirm',
                    ]);
                    // Create loss notification using your existing system
                    UserNotification::create([
                        'user_id' => $trade->user_id,
                        'title' => 'Trade Completed',
                        'message' => "Your {$trade->crypto_symbol} {$trade->direction} trade was completed. Better luck next time!",
                        'type' => 'info',
                        'is_read' => false,
                    ]);
                    // For loss, stake amount is already deducted, no need to return
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Trade approved successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: '.$e->getMessage(),
            ], 500);
        }
    }
}
