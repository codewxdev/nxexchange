<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function index()
    {
        return view('index'); // your Blade file name
    }

   public function fetchData()
{
    // Cache key name
    $cacheKey = 'crypto_market_data';

    // Cache duration (e.g., 2 minutes)
    $cacheDuration = now()->addMinutes(2);

    // Use Cache::remember to store and reuse data
    $currencies = Cache::remember($cacheKey, $cacheDuration, function () {
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
            'vs_currency' => 'usd',
            'ids' => 'bitcoin,ethereum,tether,solana,cardano,toncoin,avalanche,polkadot,dogecoin,shiba-inu,tron,litecoin,uniswap,chainlink,stellar,vechain,filecoin,theta-network,monero,ethereum-classic',
        ]);

        // Return response JSON
        return $response->json();
    });

    return $currencies;
}



}
