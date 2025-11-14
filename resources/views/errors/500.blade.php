@extends('Layouts.FrontLayout')

@section('content')
    <div class="error-container">
        <div class="error-wrapper">
            <div class="error-code">500</div>
            <div class="error-title">Server Error</div>
            <p class="error-msg">Something went wrong on our end. Please try again later.</p>
            <a href="{{ url('/') }}" class="error-btn">Reload</a>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
@endpush
