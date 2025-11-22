@extends('Layouts.FrontLayout')

@section('content')
<div class="address-page-container py-5 px-3 d-flex justify-content-center">
    
    <div class="address-wrapper">

        <!-- Back Button -->
        <a href="{{ url()->previous() }}" class="back-btn d-flex align-items-center mb-4">
            <i class="fa-solid fa-arrow-left me-2"></i> Back
        </a>

        <!-- Page Title -->
        <h2 class="text-white fw-bold mb-4">My Wallet Address</h2>

        <!-- Card -->
        <div class="glass-card p-4">

            <!-- Existing Address -->
            @if (!empty($address))
                <div class="existing-address-box p-3 mb-4">
                    <h6 class="text-muted mb-1">Current Address</h6>
                    <p class="text-white address-text">{{ $address->address }}</p>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('wallet.address.store') }}" method="POST">
                @csrf
                
                <label class="text-white mb-1">Enter New Wallet Address</label>
                <input type="text" 
                       name="address" 
                       class="form-control mb-3 address-input"
                       placeholder="Paste your wallet address..."
                       required>

                <button type="submit" class="save-btn w-100">Save Address</button>
            </form>

        </div>
    </div>

</div>
@endsection

@push('style')
<style>
    .address-page-container {
        background: radial-gradient(circle at top left, #010101, #0f0f0f);
        min-height: 100vh;
    }

    /* Wrapper — fixes card width for large screens */
    .address-wrapper {
        width: 100%;
        max-width: 550px;       /* Perfect size */
    }

    .back-btn {
        color: #F46523;
        text-decoration: none;
        font-size: 1rem;
        transition: 0.3s;
    }
    .back-btn:hover {
        color: #fff;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 18px;
        backdrop-filter: blur(15px);
        box-shadow: 0 0 25px rgba(244, 101, 35, 0.1);
    }

    .existing-address-box {
        background: rgba(255, 255, 255, 0.06);
        border-left: 4px solid #F46523;
        border-radius: 10px;
        word-break: break-all;
    }

    .address-input {
        background: rgba(255, 255, 255, 0.08);
        border: none;
        color: #fff;
    }
    .address-input::placeholder {
        color: #aaa;
    }

    .save-btn {
        background-color: #F46523;
        border: none;
        border-radius: 10px;
        padding: 10px 0;
        color: #fff;
        font-weight: 500;
        font-size: 16px;
        transition: 0.3s;
    }
    .save-btn:hover {
        background-color: #d3541d;
    }

    /* Mobile Fixes */
    @media(max-width: 576px) {
        .address-wrapper {
            max-width: 100%;
        }
    }
</style>
@endpush
