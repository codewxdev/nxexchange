@extends('Layouts.FrontLayout')

@section('content')
    <div class="container py-5">

        <!-- Page Heading -->
        <div class="text-center mb-5">
            <h2 class="text-white fw-bold">Share & Invite</h2>
            <p class="text-secondary">Invite friends and earn exclusive rewards</p>
        </div>

        <!-- QR Code Section -->
        <div class="d-flex justify-content-center mb-4">
            <div class="qr-card p-4 rounded shadow-lg text-center">
                <div id="qrContainer" class="p-3 bg-white rounded">

                    {{-- Dynamic QR Code --}}
                    <div id="userQrCode"></div>

                </div>

                <button id="saveQrBtn" class="btn mt-3 save-btn w-100">
                    <i class="fa-solid fa-download me-2"></i> Save QR Code
                </button>
            </div>
        </div>

        <!-- Invitation Info -->
        <div class="info-card p-4 rounded shadow-lg">
            <div class="mb-3">
                <label class="text-secondary">Invitation Code</label>
                <div class="copy-box">
                    <input type="text" id="inviteCode" value="{{ $user->referral_code }}" readonly>
                    <button class="copy-btn" onclick="copyText('{{ $user->referral_code }}')">
                        Copy
                    </button>
                </div>
            </div>

            <div>
                <label class="text-secondary">Invitation Link</label>
                <div class="copy-box">
                    <input type="text" id="inviteLink" value="{{ $referral_link }}" readonly>
                    <button class="copy-btn" onclick="copyText('{{ $referral_link }}')">
                        Copy
                    </button>
                </div>
            </div>

        </div>
        <div class="row m-0 d-flex gap-2">
            <!-- Referral Count Glass Box -->
            <div class="col referral-glass-card mt-5 p-4 text-center rounded-4 shadow-lg">
                <h4 class="text-white mb-2">Total Referrals</h4>
                <p class="referral-count-number" id="refCount">{{ $total_referrals }}</p>
            </div>
            <!-- Referral Count Glass Box -->
            <div class="col referral-glass-card mt-5 p-4 text-center rounded-4 shadow-lg">
                <h4 class="text-white mb-2">Level</h4>
                <p class="referral-count-number" id="refCount">V{{ $total_referrals }}</p>
            </div>
        </div>

    </div>
@endsection

@push('style')
    <style>
        body {
            background-color: #010101;
        }

        .qr-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(244, 101, 35, 0.2);
            backdrop-filter: blur(6px);
            border-radius: 15px;
            width: 300px;
        }

        .save-btn {
            background-color: #F46523;
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            transition: .3s;
        }

        .save-btn:hover {
            background-color: #d55319;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(244, 101, 35, 0.2);
            backdrop-filter: blur(6px);
            border-radius: 15px;
            max-width: 500px;
            margin: auto;
        }

        .copy-box {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .copy-box input {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: #1a1a1a;
            color: #fff;
        }

        .copy-btn {
            background: #F46523;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: .3s;
        }

        .copy-btn:hover {
            background: #d55319;
        }

        .referral-glass-card {
            /* width: 50%; */
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            transition: 0.3s ease-in-out;
        }

        .referral-glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.55);
        }

        .referral-count-number {
            font-size: 58px;
            font-weight: 800;
            color: #00eaff;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.6);
            margin: 0;
            letter-spacing: 2px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <script>
        // Generate QR Code
        let referralLink = "{{ $referral_link }}";

        var qrcode = new QRCode(document.getElementById("userQrCode"), {
            text: referralLink,
            width: 180,
            height: 180,
            colorDark: "#000000",
            colorLight: "#ffffff",
        });

        document.getElementById('saveQrBtn').addEventListener('click', () => {
            const canvas = document.querySelector('#userQrCode canvas');

            const link = document.createElement('a');
            link.href = canvas.toDataURL();
            link.download = "referral_qr.png";
            link.click();
        });

        function copyText(text) {
            navigator.clipboard.writeText(text);
            alert("Copied!");
        }

        document.getElementById('saveQrBtn').addEventListener('click', () => {
            const img = document.querySelector('.qr-img').src;

            const link = document.createElement('a');
            link.href = img;
            link.download = "referral_qr.png";
            link.click();
        });
    </script>
@endpush
