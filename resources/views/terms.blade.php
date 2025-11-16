@extends('Layouts.FrontLayout')

@section('content')
<div class="container py-5">

    <a href="{{ url()->previous() }}" class="text-primary mb-3" style="display:inline-block;">
        &larr; Back
    </a>

    <div class="p-4 rounded shadow" 
         style="background:rgba(255,255,255,0.05); backdrop-filter:blur(15px);">

        <h2 class="text-white mb-3">Terms of Service</h2>

        <p class="text-white-50">
            Welcome to NxExchange. By accessing or using our services, you agree to follow our 
            terms and conditions. These policies ensure a secure and transparent trading 
            experience for all users.
        </p>

        <h5 class="text-white mt-4">1. User Responsibilities</h5>
        <p class="text-white-50">
            Users must provide accurate information and follow all compliance rules...
        </p>

        <h5 class="text-white mt-4">2. Account & Security</h5>
        <p class="text-white-50">
            You are responsible for maintaining account confidentiality...
        </p>

        <h5 class="text-white mt-4">3. Trading Guidelines</h5>
        <p class="text-white-50">
            All trading activity must comply with applicable financial laws...
        </p>

    </div>
</div>
@endsection
