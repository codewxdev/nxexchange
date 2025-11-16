@extends('Layouts.FrontLayout')

@section('content')
<div class="container py-5">

    <!-- Back link -->
    <a href="{{ route('home') }}" class="text-primary mb-4 d-inline-block">
        &larr; Back
    </a>

    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="text-white fw-bold display-5">Contact Us</h1>
        <p class="text-muted fs-5">We’re here to help! Reach out anytime and our support team will get back to you.</p>
    </div>

    <div class="row g-4">
        <!-- Left Info Box -->
        <div class="col-lg-5">
            <div class="contact-box p-4 h-100">
                <h3 class="fw-bold text-white mb-3">Get in Touch</h3>
                <p class="text-muted mb-4">
                    Whether you have questions, need assistance, or want to give feedback — we’re always available.
                </p>

                <div class="d-flex align-items-start mb-4">
                    <div class="icon-wrapper me-3">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Email</h6>
                        <p class="text-muted mb-0">support@example.com</p>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="icon-wrapper me-3">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Phone</h6>
                        <p class="text-muted mb-0">+123 456 7890</p>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="icon-wrapper me-3">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h6 class="text-white mb-1">Office</h6>
                        <p class="text-muted mb-0">Global Crypto Street, Digital City</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Contact Form -->
        <div class="col-lg-7">
            <div class="contact-box p-4 h-100">
                <h3 class="fw-bold text-white mb-4">Send Us a Message</h3>

                <form action="#" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-white mb-1">Your Name</label>
                            <input type="text" class="form-control contact-input" placeholder="Enter name">
                        </div>

                        <div class="col-md-6">
                            <label class="text-white mb-1">Email Address</label>
                            <input type="email" class="form-control contact-input" placeholder="Enter email">
                        </div>

                        <div class="col-12">
                            <label class="text-white mb-1">Subject</label>
                            <input type="text" class="form-control contact-input" placeholder="Enter subject">
                        </div>

                        <div class="col-12">
                            <label class="text-white mb-1">Message</label>
                            <textarea class="form-control contact-input" rows="5" placeholder="Write your message..."></textarea>
                        </div>

                        <div class="col-12 mt-3">
                            <button class="btn btn-primary w-100 py-2 fw-bold">
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
@endsection

@push('style')
<style>
    body {
        background-color: #1c1c1e;
    }

    .contact-box {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        border-radius: 14px;
        border: 1px solid rgba(255, 255, 255, 0.06);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .contact-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.35);
    }

    .contact-input {
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        border-radius: 10px;
        padding: 10px;
    }

    .contact-input::placeholder {
        color: #b8b8b8;
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-wrapper i {
        font-size: 20px;
        color: #0d6efd;
    }

    button.btn-primary {
        background-color: #0d6efd;
        border: none;
        border-radius: 10px;
        font-size: 16px;
    }

    button.btn-primary:hover {
        background-color: #0b5ed7;
    }
</style>
@endpush
