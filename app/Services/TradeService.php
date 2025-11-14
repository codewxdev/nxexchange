<?php

namespace App\Services;

use App\Models\Ledger;
use App\Models\Trade;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;

class TradeService
{
    /**
     * Place a trade by staking 1% of the user's exchange balance.
     *
     * @param  string  $direction  Call/Put (case insensitive)
     * @param  int|null  $signalId  Optional signal reference
     * @param  string  $symbol  Crypto symbol (defaults to BTC)
     */
    public function placeTrade(int $userId, string $direction, ?int $signalId, string $symbol = 'BTC'): Trade
    {
        $normalizedDirection = ucfirst(strtolower($direction));

        if (! in_array($normalizedDirection, ['Call', 'Put'], true)) {
            throw new InvalidArgumentException('Direction must be Call or Put.');
        }

        return DB::transaction(function () use ($userId, $normalizedDirection, $signalId, $symbol) {
            $wallet = Wallet::where('user_id', $userId)->lockForUpdate()->first();

            if (! $wallet) {
                throw new ModelNotFoundException('Wallet not found for the authenticated user.');
            }

            // 1% of exchange balance
            $stake = bcmul($wallet->exchange_account_balance, '0.01', 2);

            if (bccomp($stake, '0', 2) <= 0) {
                throw new RuntimeException('Unable to calculate stake from zero balance.');
            }

            if (bccomp($wallet->exchange_account_balance, $stake, 2) < 0) {
                throw new RuntimeException('Insufficient funds to place trade.');
            }

            // Deduct stake
            $wallet->exchange_account_balance = bcsub($wallet->exchange_account_balance, $stake, 2);
            $wallet->save();

            // Record ledger entry
            Ledger::create([
                'user_id' => $userId,
                'type' => 'trade_stake',
                'amount' => -1 * (float) $stake,
                'balance_after' => $wallet->exchange_account_balance,
                'notes' => 'Stake for '.$normalizedDirection.' '.$symbol.' trade',
            ]);

            // Random profit rate between 70% and 73%
            $profitRate = bcdiv((string) random_int(7000, 7300), '10000', 4);

            return Trade::create([
                'user_id' => $userId,
                'direction' => $normalizedDirection,
                'trade_type' => $signalId ? 'signal' : 'self',
                'signal_id' => $signalId,
                'crypto_symbol' => strtoupper($symbol),
                'stake_amount' => $stake,
                'profit_rate' => $profitRate,
                'start_time' => Carbon::now(),
            ]);
        }, 3);
    }

    /**
     * Settle a collection of trade IDs and credit winnings.
     */
    public function settleTrades(array $tradeIds, string $winningDirection): void
    {
        if (empty($tradeIds)) {
            return;
        }

        $normalizedDirection = ucfirst(strtolower($winningDirection));

        DB::transaction(function () use ($tradeIds, $normalizedDirection) {
            $trades = Trade::whereIn('id', $tradeIds)->lockForUpdate()->get();

            foreach ($trades as $trade) {
                if ($trade->result !== 'pending') {
                    continue;
                }

                $wallet = Wallet::where('user_id', $trade->user_id)->lockForUpdate()->first();

                if (! $wallet) {
                    continue;
                }

                if ($trade->direction === $normalizedDirection) {
                    $profit = bcmul($trade->stake_amount, $trade->profit_rate, 8);
                    $credit = bcadd($trade->stake_amount, $profit, 8);

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
                    $trade->profit_amount = 0;
                    $trade->result = 'lose';
                }

                $trade->end_time = Carbon::now();
                $trade->save();
            }
        }, 3);
    }

    /**
     * Handle self-trade resolution, ensuring majority side loses and single trades auto-lose.
     */
    public function handleSelfTradesMatching(): void
    {
        DB::transaction(function () {
            $pending = Trade::where('trade_type', 'self')
                ->where('result', 'pending')
                ->lockForUpdate()
                ->get();

            if ($pending->isEmpty()) {
                return;
            }

            $callTrades = $pending->where('direction', 'Call');
            $putTrades = $pending->where('direction', 'Put');

            $callSum = $callTrades->sum('stake_amount');
            $putSum = $putTrades->sum('stake_amount');

            if ($callTrades->isNotEmpty() && $putTrades->isEmpty()) {
                $winning = 'Put';
            } elseif ($putTrades->isNotEmpty() && $callTrades->isEmpty()) {
                $winning = 'Call';
            } elseif (bccomp((string) $callSum, (string) $putSum, 8) === 0) {
                $winning = random_int(0, 1) === 0 ? 'Call' : 'Put';
            } else {
                $winning = $callSum > $putSum ? 'Put' : 'Call';
            }

            $this->settleTrades($pending->pluck('id')->toArray(), $winning);
        }, 3);
    }
}
