<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class MarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('market');
    }

    // public function cryptoData()
    // {
    //     $cryptoData = Cache::remember('crypto_data', 10, function () {
    //         $api = 'https://api.coingecko.com/api/v3/coins/markets';
    //         $params = http_build_query([
    //             'vs_currency' => 'usd',
    //             'order' => 'market_cap_desc',
    //             'per_page' => 100,
    //             'page' => 1,
    //             'sparkline' => false,
    //         ]);

    //         $url = $api.'?'.$params;

    //         $response = Http::get($url);

    //         if ($response->failed()) {
    //             return [];
    //         }

    //         return $response->json();
    //     });

    //     return response()->json($cryptoData);
    // }
    public function cryptoData()
    {
        $cacheKey = 'crypto_market_page_1';
        $cacheDuration = now()->addMinutes(2);

        $currencies = Cache::remember($cacheKey, $cacheDuration, function () {

            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'order' => 'market_cap_desc',
                'per_page' => 100, // only 100 coins
                'page' => 1,       // only page 1
                'sparkline' => false,
            ]);

            if ($response->failed()) {
                return [];
            }

            return $response->json(); // return only first 100 coins
        });

        return $currencies;
    }
}
