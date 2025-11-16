@extends('Layouts.FrontLayout')

@section('content')
    <div class="kyc-wrapper">
        <div class="kyc-card">

            <h2>KYC Verification</h2>
            <p class="kyc-subtitle">Verify your identity to secure your account & unlock full trading features.</p>

            <form class="kyc-form" action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
{{-- 
                <label>Full Name</label>
                <input type="text" name="full_name" required placeholder="Enter your full name"> --}}

                <label>Country</label>
                <select name="country" required>
                    <option value="" disabled selected>Select your country</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="UAE">United Arab Emirates</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Qatar">Qatar</option>
                    <option value="USA">USA</option>
                </select>

                <label>ID Card Number / CNIC</label>
                <input type="text" name="cnic" required placeholder="e.g. 35202-1234567-8">

                <label>CNIC Front Image</label>
                <div class="upload-box" onclick="document.getElementById('front_img').click()">
                    <p>Click to upload front side</p>
                    <img id="front_preview" class="preview-img">
                </div>
                <input type="file" name="cnic_front" id="front_img" accept="image/*" style="display:none" required>

                <label>CNIC Back Image</label>
                <div class="upload-box" onclick="document.getElementById('back_img').click()">
                    <p>Click to upload back side</p>
                    <img id="back_preview" class="preview-img">
                </div>
                <input type="file" name="cnic_back" id="back_img" accept="image/*" style="display:none" required>

                <button type="submit" class="kyc-submit-btn">Submit Verification</button>

            </form>
        </div>
    </div>

    <script>
        // Preview Images
        const frontImg = document.getElementById("front_img");
        const frontPreview = document.getElementById("front_preview");

        const backImg = document.getElementById("back_img");
        const backPreview = document.getElementById("back_preview");

        frontImg.addEventListener("change", () => {
            frontPreview.src = URL.createObjectURL(frontImg.files[0]);
            frontPreview.style.display = "block";
        });

        backImg.addEventListener("change", () => {
            backPreview.src = URL.createObjectURL(backImg.files[0]);
            backPreview.style.display = "block";
        });
    </script>
@endsection


@push('style')
    <style>
        .kyc-wrapper {
            min-height: 100vh;
            padding: 60px 0;
            background: linear-gradient(135deg, #020202, #0a0f1a);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .kyc-card {
            width: 100%;
            max-width: 750px;
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.06);
            padding: 40px;
            border-radius: 22px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.97);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .kyc-card h2 {
            color: #fff;
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .kyc-subtitle {
            color: #b5b5b5;
            text-align: center;
            margin-bottom: 35px;
            font-size: 15px;
        }

        .kyc-form label {
            color: #e8e8e8;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .kyc-form input,
        .kyc-form select {
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            padding: 12px;
            color: #fff;
            margin-bottom: 18px;
        }

        .kyc-form input:focus,
        .kyc-form select:focus {
            border-color: #00bfff;
            outline: none;
            box-shadow: 0 0 10px rgba(0, 191, 255, 0.3);
        }

        .kyc-form select option {
            color: black
        }

        .upload-box {
            border: 2px dashed rgba(255, 255, 255, 0.14);
            border-radius: 12px;
            padding: 18px;
            text-align: center;
            color: #dcdcdc;
            margin-bottom: 20px;
            cursor: pointer;
            transition: 0.3s;
            background: rgba(255, 255, 255, 0.03);
        }

        .upload-box:hover {
            border-color: #00bfff;
            background: rgba(255, 255, 255, 0.06);
        }

        .upload-box p {
            margin: 5px 0;
        }

        .preview-img {
            width: 100%;
            max-height: 180px;
            object-fit: cover;
            margin-top: 12px;
            border-radius: 10px;
            display: none;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .kyc-submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #007bff, #00d4ff);
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 700;
            transition: 0.3s ease;
            box-shadow: 0 0 18px rgba(0, 191, 255, 0.3);
            color: #fff;
            margin-top: 10px;
        }

        .kyc-submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(0, 191, 255, 0.6);
        }

        @media (max-width: 600px) {
            .kyc-card {
                padding: 25px;
            }

            .kyc-card h2 {
                font-size: 27px;
            }
        }
    </style>
@endpush
