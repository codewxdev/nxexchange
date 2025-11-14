<?php

namespace App\Jobs;

use App\Models\Signal;
use App\Models\Trade;
use App\Services\TradeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SettleTradesForSignal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The signal to settle.
     */
    public function __construct(private readonly int $signalId)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(TradeService $tradeService): void
    {
        $signal = Signal::find($this->signalId);

        if (!$signal) {
            return;
        }

        $tradeIds = Trade::where('signal_id', $this->signalId)
            ->where('result', 'pending')
            ->pluck('id')
            ->toArray();

        if (empty($tradeIds)) {
            return;
        }

        $tradeService->settleTrades($tradeIds, $signal->direction);
    }
}

