@extends('Layouts.FrontLayout')

@section('content')
    <div class="asset-container py-5 px-3 text-center">

        <h2 class="text-white">Deposit Payment</h2>
        <p class="text-muted">Send the payment to the address below</p>

        <div class="glass-card p-4">

            <h4 class="text-white mb-2">
                Amount: {{ $deposit->amount }} {{ $deposit->currency }}
            </h4>

            <h5 class="text-white mt-3">Wallet Address:</h5>
            {{-- <p class="text-info">{{ $deposit->address }}</p> --}}
            @if ($deposit->address)
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($deposit->address) }}"
                    alt="Deposit QR" />
                <p>Or click here: <a href="{{ $deposit->address }}" target="_blank">Pay Now</a></p>
            @else
                <p>Invoice is being generated. Please wait...</p>
            @endif
 
        </div>

    </div>
@endsection
