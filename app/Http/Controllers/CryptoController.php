<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CryptoController extends Controller
{
    public function index()
    {
        return view('index'); // your Blade file name
    }

    public function fetchData()
    {
        $response = Http::get('https://api.coingecko.com/api/v3/coins/markets', [
            'vs_currency' => 'usd',
            'ids' => 'bitcoin,ethereum,tether,solana,cardano,Toncoin,Avalanche,Polkadot,Dogecoin,Shiba Inu,Litecoin,TRON,Uniswap,Chainlink,Stellar,VeChain,Filecoin,Theta Network,Monero,EOS,Tezos,Cosmos,Algorand,Elrond,Bitcoin Cash,Aave,Celsius,Compound,Dash,Zcash,Maker,Neo,SushiSwap,Yearn.finance,PancakeSwap,Huobi Token,FTX Token,OKB,KuCoin Token,GateToken',
        ]);

        return $response->json();
    }
}
