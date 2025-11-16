@extends('Layouts.FrontLayout')

@section('content')
<div class="container py-5">

    <a href="{{ url()->previous() }}" class="text-primary mb-3" style="display:inline-block;">
        &larr; Back
    </a>

    <div class="p-4 rounded shadow"
         style="background:rgba(255,255,255,0.05); backdrop-filter:blur(15px);">

        <h2 class="text-white mb-3">Privacy Statement</h2>

        <p class="text-white-50">
            Your privacy is extremely important to us. NxExchange ensures the safety of your 
            personal data by following strict security protocols and encryption standards.
        </p>

        <h5 class="text-white mt-4">1. Data Collection</h5>
        <p class="text-white-50">
            We only collect essential information such as identity verification details...
        </p>

        <h5 class="text-white mt-4">2. Data Usage</h5>
        <p class="text-white-50">
            Your information is used solely for verification, security, and improving services...
        </p>

        <h5 class="text-white mt-4">3. Third-Party Policies</h5>
        <p class="text-white-50">
            We do not share your information with third parties without consent...
        </p>

    </div>
</div>
@endsection
