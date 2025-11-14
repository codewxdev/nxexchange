<?php

namespace App\Services;

use App\Models\Ledger;
use App\Models\Trade;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TradeService
{
    public function placeTrade(int $userId, string $direction, ?int $signalId, string $symbol = 'BTC'): Trade
    {
        return DB::transaction(function () use ($userId, $direction, $signalId, $symbol) {
            // Get user wallet with lock to prevent concurrent modifications
            $wallet = Wallet::where('user_id', $userId)->lockForUpdate()->first();

            if (! $wallet) {
                throw new \Exception('Wallet not found for user');
            }

            // Calculate 1% of account balance
            $balance = (float) $wallet->exchange_account_balance;
            $stake = bcmul((string) $balance, '0.01', 8); // 1% of balance

            // Check if user has sufficient balance
            if (bccomp($stake, '0', 8) <= 0 || bccomp($wallet->exchange_account_balance, $stake, 8) < 0) {
                throw new \Exception('Insufficient balance to place trade');
            }

            // Deduct stake from wallet
            $wallet->exchange_account_balance = bcsub($wallet->exchange_account_balance, $stake, 8);
            $wallet->save();

            // ledger debit
            Ledger::create([
                'user_id' => $userId,
                'type' => 'trade_stake',
                'amount' => -1 * (float) $stake,
                'balance_after' => $wallet->exchange_account_balance,
                'notes' => 'Stake for '.ucfirst($direction).' '.$symbol,
            ]);

            // store exact profit rate used for this trade (randomized between 0.70 and 0.73)
            $profitRate = number_format((rand(7000, 7300) / 10000), 4);

            $trade = Trade::create([
                'user_id' => $userId,
                'direction' => ucfirst($direction),
                'trade_type' => $signalId ? 'signal' : 'self',
                'signal_id' => $signalId,
                'crypto_symbol' => $symbol,
                'stake_amount' => $stake,
                'profit_rate' => $profitRate,
                'start_time' => Carbon::now(),
            ]);

            return $trade;
        }, 3);
    }

    public function settleTrades(array $tradeIds, string $winningDirection)
    {
        DB::transaction(function () use ($tradeIds, $winningDirection) {
            $trades = Trade::whereIn('id', $tradeIds)->lockForUpdate()->get();

            foreach ($trades as $trade) {
                if ($trade->result !== 'pending') {
                    continue;
                }

                if (strtolower($trade->direction) === strtolower($winningDirection)) {
                    // winner: credit stake + profit
                    $profit = bcmul((string) $trade->stake_amount, (string) $trade->profit_rate, 8);
                    $credit = bcadd((string) $trade->stake_amount, (string) $profit, 8);

                    $wallet = Wallet::where('user_id', $trade->user_id)->lockForUpdate()->first();
                    $wallet->exchange_account_balance = bcadd($wallet->exchange_account_balance, $credit, 8);
                    $wallet->save();

                    Ledger::create([
                        'user_id' => $trade->user_id,
                        'type' => 'trade_win',
                        'amount' => (float) $credit,
                        'balance_after' => $wallet->exchange_account_balance,
                        'notes' => 'Win for trade #'.$trade->id,
                    ]);

                    $trade->profit_amount = $profit;
                    $trade->result = 'win';
                } else {
                    // lost -> stake already deducted
                    $trade->profit_amount = 0;
                    $trade->result = 'lose';
                }

                $trade->end_time = Carbon::now();
                $trade->save();
            }
        }, 3);
    }

    public function handleSelfTradesMatching()
    {
        // select pending self trades within a short window (example: all pending self trades)
        DB::transaction(function () {
            $pending = Trade::where('trade_type', 'self')->where('result', 'pending')->lockForUpdate()->get();
            if ($pending->isEmpty()) {
                return;
            }

            $callTrades = $pending->where('direction', 'Call');
            $putTrades = $pending->where('direction', 'Put');

            $callCount = $callTrades->count();
            $putCount = $putTrades->count();
            $callSum = $callTrades->sum('stake_amount');
            $putSum = $putTrades->sum('stake_amount');

            // If only one user places a trade (Call or Put), the opposite side wins and that trade loses
            if ($callCount > 0 && $putCount == 0) {
                // Only Call trades exist - Put wins (opposite side), Call loses
                $winning = 'Put';
            } elseif ($putCount > 0 && $callCount == 0) {
                // Only Put trades exist - Call wins (opposite side), Put loses
                $winning = 'Call';
            } elseif ($callSum == $putSum) {
                // tie: choose random winner to break tie
                $winning = (rand(0, 1) === 0) ? 'Call' : 'Put';
            } else {
                // side with higher total loses
                $winning = ($callSum > $putSum) ? 'Put' : 'Call';
            }

            $this->settleTrades($pending->pluck('id')->toArray(), $winning);
        }, 3);
    }
}
