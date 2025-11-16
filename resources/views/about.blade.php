@extends('Layouts.FrontLayout')

@section('content')
<div class="container py-5">
    <!-- Back link -->
    <a href="{{ route('home') }}" class="text-primary mb-4 d-inline-block">
        &larr; Back
    </a>

    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="text-white display-5 fw-bold">About Us</h1>
        <p class="text-muted fs-5">Discover who we are and what drives our mission in the world of cryptocurrency.</p>
    </div>

    <!-- Mission & Vision Section -->
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card about-card h-100 p-4">
                <div class="icon-wrapper mb-3">
                    <i class="fa-solid fa-bullseye fa-2x text-primary"></i>
                </div>
                <h4 class="text-white fw-bold">Our Mission</h4>
                <p class="text-muted">We aim to empower individuals worldwide with secure, innovative, and accessible cryptocurrency solutions that enhance financial freedom.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card about-card h-100 p-4">
                <div class="icon-wrapper mb-3">
                    <i class="fa-solid fa-eye fa-2x text-primary"></i>
                </div>
                <h4 class="text-white fw-bold">Our Vision</h4>
                <p class="text-muted">To become the most trusted and user-friendly cryptocurrency platform, bridging the gap between traditional finance and digital assets.</p>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="text-center mb-4">
        <h2 class="text-white fw-bold">Our Core Values</h2>
        <p class="text-muted mb-4">What drives our team every day</p>
    </div>

    <div class="row g-4">
        <div class="col-md-3 col-sm-6">
            <div class="card about-card h-100 text-center p-4">
                <i class="fa-solid fa-lock fa-2x mb-3 text-primary"></i>
                <h5 class="text-white fw-bold">Security</h5>
                <p class="text-muted">Your assets and data are protected with top-notch security measures.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card about-card h-100 text-center p-4">
                <i class="fa-solid fa-rocket fa-2x mb-3 text-primary"></i>
                <h5 class="text-white fw-bold">Innovation</h5>
                <p class="text-muted">We continuously enhance our platform with cutting-edge features and technology.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card about-card h-100 text-center p-4">
                <i class="fa-solid fa-users fa-2x mb-3 text-primary"></i>
                <h5 class="text-white fw-bold">Community</h5>
                <p class="text-muted">Our users and community are at the heart of everything we do.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="card about-card h-100 text-center p-4">
                <i class="fa-solid fa-handshake fa-2x mb-3 text-primary"></i>
                <h5 class="text-white fw-bold">Integrity</h5>
                <p class="text-muted">We maintain transparency, honesty, and trustworthiness in every interaction.</p>
            </div>
        </div>
    </div>

    <!-- Placeholder content section -->
    <div class="mt-5 text-center text-muted">
        <p>More information about our journey, team, and projects will appear here soon. Stay tuned for updates!</p>
    </div>
</div>
@endsection

@push('style')
<style>
    body {
        background-color: #1c1c1e;
    }

    .about-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        border: none;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    }

    .icon-wrapper i {
        padding: 15px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    @media (max-width: 767px) {
        .about-card {
            text-align: center;
        }
    }
</style>
@endpush
