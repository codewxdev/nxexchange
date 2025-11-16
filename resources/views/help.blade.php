@extends('Layouts.FrontLayout')

@section('content')
    <div class="container py-5">
        <!-- Back link (hidden initially) -->
        <a href="javascript:void(0)" id="backLink" class="text-primary mb-3 d-none" style="display: inline-block;">
            &larr; Back to Help Center
        </a>

        <!-- Logo -->
        <div class="text-center mb-5">
            <img src="{{ asset('assets/images/logo3.png') }}" alt="NxExchange" style="width:70px;">
            <h2 class="mt-3 text-white">Help Center</h2>
        </div>

        <!-- Help boxes -->
        <div class="row justify-content-center" id="helpBoxes">
            <div class="col-md-3 col-sm-6 mb-4">
                <a href="{{ route('help.terms') }}" class="text-decoration-none">
                    <div class="help-box p-4 text-center rounded shadow cursor-pointer">
                        <i class="fa-solid fa-file-contract fa-2x mb-2" style="color:#ff783a;"></i>
                        <h5 class="mt-2 text-white">Terms of Service</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="{{ route('help.privacy') }}" class="text-decoration-none">
                    <div class="help-box p-4 text-center rounded shadow cursor-pointer">
                        <i class="fa-solid fa-shield-halved fa-2x mb-2" style="color:#ff783a;"></i>
                        <h5 class="mt-2 text-white">Privacy Statement</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="{{ route('about.index') }}" class="text-decoration-none">
                    <div class="help-box p-4 text-center rounded shadow cursor-pointer">
                        <i class="fa-solid fa-circle-info fa-2x mb-2" style="color:#ff783a;"></i>
                        <h5 class="mt-2 text-white">About Us</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <a href="{{ route('help.financial') }}" class="text-decoration-none">
                    <div class="help-box p-4 text-center rounded shadow cursor-pointer">
                        <i class="fa-solid fa-landmark fa-2x mb-2" style="color:#ff783a;"></i>
                        <h5 class="mt-2 text-white">Financial Crimes</h5>
                    </div>
                </a>
            </div>
        </div>


        <!-- Glass overlay (not needed anymore but kept as you said "don't change anything") -->
        <div id="helpOverlay" class="glass-overlay d-none p-4 rounded">
            <h4 id="helpTitle" class="text-white mb-3"></h4>
            <p id="helpDesc" class="text-white"></p>
        </div>
    </div>
@endsection

@push('style')
    <style>
        body {
            background-color: #1c1c1e;
        }

        .help-box {
            background: rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .help-box:hover {
            background: rgba(255, 120, 58, 0.15);
            transform: translateY(-5px);
        }

        .glass-overlay {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: contents;
        }
    </style>
@endpush
