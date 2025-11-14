<?php

namespace App\Jobs;

use App\Models\Signal;
use App\Services\TradeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SettleTradesForSignal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $signalId;

    /**
     * Create a new job instance.
     */
    public function __construct(int $signalId)
    {
        $this->signalId = $signalId;
    }

    /**
     * Execute the job.
     */
    public function handle(TradeService $tradeService): void
    {
        $signal = Signal::find($this->signalId);

        if (! $signal) {
            return;
        }

        // Get all pending trades for this signal
        $trades = \App\Models\Trade::where('signal_id', $this->signalId)
            ->where('result', 'pending')
            ->pluck('id')
            ->toArray();

        if (empty($trades)) {
            return;
        }

        // The winning direction is the signal's direction
        // If signal is Call, Call wins; if signal is Put, Put wins
        $winningDirection = $signal->direction;

        // Settle all trades for this signal
        $tradeService->settleTrades($trades, $winningDirection);
    }
}
