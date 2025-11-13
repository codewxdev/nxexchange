<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; // ✅ Add Cache facade



class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
        $currencies = Cache::remember('currencies_data', now()->addMinutes(2), function () {
            $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
                'vs_currency' => 'usd',
                'ids' => 'bitcoin,ethereum,tether,solana,cardano,toncoin,avalanche,polkadot,dogecoin,shiba-inu,tron,litecoin,uniswap,chainlink,stellar,vechain,filecoin,theta-network,monero,ethereum-classic',
            ]);

            return $response->json();
        });

        return view('trades', compact('currencies'));
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
