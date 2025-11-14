<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use App\Models\Wallet;
use App\Services\TradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $signalBuys = Signal::where('is_active', 1)->where('direction', 'Call')->get();
        $signalSells = Signal::where('is_active', 1)->where('direction', 'Put')->get();
        $wallet = Wallet::where('user_id', auth()->id())->first();

        $currencies = Cache::remember('currencies_data', now()->addMinutes(2), function () {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'ids' => 'bitcoin,ethereum,tether,solana,cardano,toncoin,avalanche,polkadot,dogecoin,shiba-inu,tron,litecoin,uniswap,chainlink,stellar,vechain,filecoin,theta-network,monero,ethereum-classic',
            ]);

            return $response->json();
        });

        return view('trades', compact('currencies', 'signalBuys', 'wallet', 'signalSells'));
    }

    public function __construct(TradeService $service)
    {
        $this->service = $service;
    }

    public function place(Request $req)
    {
        $req->validate([
            'direction' => 'required|in:call,put',
            'signal_id' => 'nullable|exists:signals,id',
            'symbol' => 'nullable|string',
        ]);

        $user = Auth::user();
        $direction = $req->input('direction');
        $signalId = $req->input('signal_id');
        $symbol = $req->input('symbol', 'BTC');

        $trade = $this->service->placeTrade($user->id, $direction, $signalId, $symbol);

        // if signal-based, dispatch job at signal end_time
        if ($signalId) {
            $signal = Signal::find($signalId);
            if ($signal && $signal->end_time) {
                $endTime = \Carbon\Carbon::parse($signal->end_time);
                $now = \Carbon\Carbon::now();
                
                if ($endTime->isPast()) {
                    // Signal already ended, settle immediately
                    \App\Jobs\SettleTradesForSignal::dispatch($signalId);
                } else {
                    // Dispatch job to settle this signal at end_time
                    // Note: Job is idempotent - multiple dispatches are safe
                    $delay = $endTime->diffInSeconds($now);
                    \App\Jobs\SettleTradesForSignal::dispatch($signalId)->delay($delay);
                }
            } elseif ($signal && !$signal->end_time) {
                // Signal has no end_time, settle immediately (admin can manually trigger)
                \App\Jobs\SettleTradesForSignal::dispatch($signalId);
            }
        } else {
            // For self trades, trigger matching immediately
            // This handles both single-user and multi-user scenarios
            $this->service->handleSelfTradesMatching();
        }

        return response()->json(['success' => true, 'trade' => $trade]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
