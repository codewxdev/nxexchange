<?php

namespace App\Http\Controllers;

use App\Jobs\SettleTradesForSignal;
use App\Models\Signal;
use App\Models\Trade;
use App\Models\Wallet;
use App\Services\TradeService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use RuntimeException;

class TradeController extends Controller
{
    public function __construct(private readonly TradeService $tradeService) {}

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

    public function executeTrade(Request $request)
    {
        $request->validate([
            'direction' => 'required|in:Call,Put,call,put',
            'crypto_symbol' => 'required|string|max:10',
            'signal_id' => 'nullable|exists:signals,id',
        ]);

        $user = Auth::user();

        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $trade = $this->tradeService->placeTrade(
                $user->id,
                $request->input('direction'),
                $request->input('signal_id'),
                $request->input('crypto_symbol', 'BTC')
            );

            if ($trade->signal_id) {
                $signal = Signal::find($trade->signal_id);

                if ($signal && $signal->end_time) {
                    $endTime = Carbon::parse($signal->end_time);
                    $now = Carbon::now();

                    if ($endTime->isPast()) {
                        SettleTradesForSignal::dispatch($signal->id);
                    } else {
                        SettleTradesForSignal::dispatch($signal->id)->delay($endTime->diffInSeconds($now));
                    }
                } elseif ($signal) {
                    SettleTradesForSignal::dispatch($signal->id);
                }
            } else {
                $this->tradeService->handleSelfTradesMatching();
            }

            $wallet = Wallet::where('user_id', $user->id)->first();

            return response()->json([
                'message' => 'Trade placed successfully.',
                'trade' => $trade,
                'new_balance' => $wallet?->exchange_account_balance,
            ], 201);
        } catch (ModelNotFoundException|InvalidArgumentException|RuntimeException $e) {
            Log::warning('Trade execution validation failed: '.$e->getMessage());

            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            Log::error('Trade execution failed: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return response()->json(['error' => 'Trade execution failed. Please try again.'], 500);
        }
    }

    public function history()
    {
        try {
            $trades = Trade::with(['user', 'signal'])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.trade', compact('trades'));

        } catch (\Exception $e) {
            return back()->with('error', 'Error loading trades: '.$e->getMessage());
        }
    }
}
