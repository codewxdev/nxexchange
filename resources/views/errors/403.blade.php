@extends('Layouts.FrontLayout')

@section('content')

<div class="error-container">
  <div class="error-wrapper">
        <div class="error-code">403</div>
        <div class="error-title">Access Denied</div>
        <p class="error-msg">You don't have permission to view this page.</p>
        <a href="{{ url('/') }}" class="error-btn">Return Home</a>
    </div>
</div>
   
@endsection

@push('style')
     <link rel="stylesheet" href="{{ asset('assets/css/error.css') }}">
@endpush
