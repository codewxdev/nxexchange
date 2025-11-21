@extends('Layouts.FrontLayout')

@section('content')
    <style>
        /* Mobile Only */
        @media (min-width: 992px) {
            .mobile-profile-page {
                display: none !important;
            }
        }

        .mobile-profile-page {
            padding: 20px;
            background: #010101;
            min-height: 100vh;
            color: #fff;
            font-family: 'Poppins', sans-serif;
        }

        /* Glass box */
        .glass-card {
            background: rgba(255, 255, 255, 0.07);
            border-radius: 18px;
            padding: 20px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            margin-bottom: 20px;
        }

        /* Profile circle */
        .profile-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #F46523;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 32px;
            font-weight: bold;
            color: #fff;
            margin: auto;
        }

        .profile-info {
            text-align: center;
            margin-top: 12px;
        }

        .info-label {
            opacity: 0.8;
            font-size: 13px;
        }

        .option-row {
            background: rgba(255, 255, 255, 0.07);
            padding: 15px;
            border-radius: 14px;
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }

        .option-row i {
            font-size: 18px;
            color: #F46523;
        }

        .logout-btn {
            background: #F46523;
            color: #fff;
            padding: 14px;
            width: 100%;
            border-radius: 14px;
            border: none;
            font-size: 16px;
            margin-top: 20px;
            font-weight: 500;
        }
    </style>

    <div class="mobile-profile-page d-lg-none d-md-none">
        <!-- Glass Profile Box -->
        <div class="glass-card text-center">
            <!-- Profile Circle -->
            <div class="profile-circle">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <!-- Info -->
            <div class="profile-info">
                <h5 class="mt-3">{{ auth()->user()->name }}</h5>
                <p class="m-0 info-label">{{ auth()->user()->email }}</p>
                <p class="m-0 info-label">ID: {{ auth()->user()->id }}</p>

                <!-- Identity Status -->
                <div class="mt-2">
                    @php $kyc = auth()->user()->kyc_status; @endphp

                    @if ($kyc === 'verified')
                        <span style="color:#00c853; font-weight:600;">✔ Identity Verified</span>
                    @elseif ($kyc === 'pending')
                        <span style="color:#ffca28; font-weight:600;">⏳ Verification Pending</span>
                    @else
                        <a href="{{ route('kyc.index') }}"
                            style="color:#F46523; font-weight:600; text-decoration:underline;">
                            Verify Identity
                        </a>
                    @endif
                   
                </div>
                    <a href="{{ route('admin.dashboard') }}" class="admin-btn">Admin Panel</a>
            </div>

        </div>

        <!-- Options -->

        <a href="{{ route('password.request') }}" class="option-row" style="text-decoration:none; color:white;">
            <span>Modify Password</span>
            <i class="fa-solid fa-angle-right"></i>
        </a>

        {{-- <a href=" " class="option-row" style="text-decoration:none; color:white;">
            <span>Payment Password</span>
            <i class="fa-solid fa-angle-right"></i>
        </a> --}}


        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>
@endsection
