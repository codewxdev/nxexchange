@extends('Layouts.FrontLayout')

@section('content')
  <div class="error-container">
 <div class="error-wrapper">
        <div class="error-code">404</div>
        <div class="error-title">Page Not Found</div>
        <p class="error-msg">The page you're looking for doesn't exist or may have been moved.</p>
        <a href="{{ url('/') }}" class="error-btn">Go Back Home</a>
    </div>
  </div>
    
@endsection

@push('style')
     <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
@endpush
