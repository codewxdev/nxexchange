<?php

namespace App\Http\Controllers;

use App\Models\Signal;
use App\Models\Trade;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trades = Trade::where('user_id', auth()->id())->orderBy('created_at', 'desc')
            ->get();
        $signalBuys = Signal::where('is_active', 1)->where('direction', 'Call')->get();
        $signalSells = Signal::where('is_active', 1)->where('direction', 'Put')->get();
        $wallet = Wallet::where('user_id', auth()->id())->first();

        $currencies = Cache::remember('currencies_data', now()->addMinutes(10), function () {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'ids' => 'bitcoin,ethereum,tether,solana,cardano,toncoin,avalanche,polkadot,dogecoin,shiba-inu,tron,litecoin,uniswap,chainlink,stellar,vechain,filecoin,theta-network,monero,ethereum-classic',
            ]);

            return $response->json();
        });

        return view('trades', compact('currencies', 'signalBuys', 'wallet', 'signalSells', 'trades'));
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

    public function executeTrade(Request $request)
    {
        try {
            $request->validate([
                'direction' => 'required|in:Call,Put',
                'crypto_symbol' => 'required|string',
                'percentage' => 'required|numeric|min:1|max:100',
                'signal_id' => 'nullable|exists:signals,id',
            ]);
            if (auth()->user()->kyc_status != 'verified') {
                return response()->json([
                    'success' => false,
                    'message' => 'KYC verification required to place trades. Please complete your KYC verification first.',
                ], 403);
            }
            if (auth()->user()->account_status != 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Account have to be active.',
                ], 403);
            }

            DB::transaction(function () use ($request) {
                // Get user'sx wallet
                $wallet = Wallet::where('user_id', auth()->id())->first();

                if (! $wallet) {
                    throw new \Exception('Wallet not found');
                }

                // Calculate stake amount
                $stakeAmount = ($wallet->trade_balance * $request->percentage) / 100;

                // Check balance
                if ($stakeAmount > $wallet->trade_balance) {
                    throw new \Exception('Insufficient trade balance');
                }

                // Deduct from trade balance
                $wallet->trade_balance -= $stakeAmount;
                $wallet->save();

                // Determine trade type CORRECTLY
                $tradeType = $request->signal_id ? 'signal' : 'self';

                // Create trade record with CORRECT columns
                Trade::create([
                    'user_id' => auth()->id(),
                    'direction' => $request->direction, // This should be Call/Put
                    'trade_type' => $tradeType, // This should be signal/self
                    'signal_id' => $request->signal_id,
                    'crypto_symbol' => $request->crypto_symbol,
                    'stake_amount' => $stakeAmount,
                    'profit_amount' => 0,
                    'profit_rate' => 0,
                    'result' => 'pending',
                    'start_time' => now(),
                    'end_time' => now()->addMinutes(5), // 5 minutes later
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Trade placed successfully! Waiting for admin approval.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function getCryptoPrice($symbol)
    {
        $currencies = Cache::get('currencies_data', []);

        foreach ($currencies as $currency) {
            if (strtoupper($currency['symbol']) === strtoupper($symbol)) {
                return $currency['current_price'];
            }
        }

        return null;
    }
}
