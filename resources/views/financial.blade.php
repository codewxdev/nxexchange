@extends('Layouts.FrontLayout')

@section('content')
<div class="container py-5">

    <a href="{{ url()->previous() }}" class="text-primary mb-3" style="display:inline-block;">
        &larr; Back
    </a>

    <div class="p-4 rounded shadow"
         style="background:rgba(255,255,255,0.05); backdrop-filter:blur(15px);">

        <h2 class="text-white mb-3">Financial Crimes Enforcement Network</h2>

        <p class="text-white-50">
            NxExchange follows international anti-money-laundering (AML) and KYC policies to 
            ensure a safe and compliant trading environment.
        </p>

        <h5 class="text-white mt-4">1. AML Compliance</h5>
        <p class="text-white-50">
            We monitor suspicious transactions and enforce strict verification checks...
        </p>

        <h5 class="text-white mt-4">2. Fraud Prevention</h5>
        <p class="text-white-50">
            Automated systems track unusual patterns to prevent fraudulent actions...
        </p>

        <h5 class="text-white mt-4">3. User Verification</h5>
        <p class="text-white-50">
            All users must complete mandatory KYC checks before using trading features...
        </p>

    </div>
</div>
@endsection
