@extends('Layouts.FrontLayout')

@section('content')
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="payment-page">
        <div class="glass-box">
            <h4 class="title">Payment Password</h4>
            <p class="subtitle">
                Set or update your secure payment password.
            </p>

            @php
                $hasPassword = auth()->user()->payment_password ? true : false;
            @endphp

            <form action="{{ route('payment.password.store') }}" method="POST">
                @csrf

                @if (!$hasPassword)
                    <!-- FIRST TIME SETTING PASSWORD -->
                    <label class="mb-1">New Payment Password</label>
                    <input type="text" name="payment_password" class="form-control input-field mb-3"
                        placeholder="Enter 6-digit payment password" minlength="6" maxlength="6" required>

                    <label class="mb-1">Confirm Password</label>
                    <input type="text" name="payment_password_confirmation" class="form-control input-field mb-3"
                        placeholder="Re-enter password" minlength="6" maxlength="6" required>
                @else
                    <!-- PASSWORD ALREADY SET -->
                    <label class="mb-1">Payment Password</label>
                    <input type="text" name="payment_password" id="editableField" class="form-control input-field mb-3"
                        value="{{ auth()->user()->payment_password }}">

                    <small style="opacity: 0.7">Click the field above to update password</small>

                    <label class="mb-1">Confirm New Password</label>
                    <input type="text" name="payment_password_confirmation" class="form-control input-field mb-3"
                        placeholder="Re-enter new password" minlength="6" maxlength="6" required>
                @endif

                <button class="submit-btn">
                    {{ $hasPassword ? 'Update Password' : 'Save Payment Password' }}
                </button>
            </form>

        </div>
    </div>
@endsection

@push('style')
    <style>
        .payment-page {
            min-height: 100vh;
            background: #010101;
            padding: 25px;
            font-family: 'Poppins', sans-serif;
            color: #fff;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.13);
            margin-top: 20px;
            flex-direction: column;
        }

        .glass-box form {
            width: 100%;
        }

        .title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #fff;
        }

        .subtitle {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 20px;
        }

        .input-field {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: white;
            border-radius: 12px;
            padding: 12px;
        }

        .input-field::placeholder {
            color: #bbb;
        }

        .submit-btn {
            background: #F46523;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-size: 16px;
            margin-top: 15px;
            width: 100%;
            font-weight: 500;
        }

        .back-btn {
            display: inline-block;
            color: #F46523;
            margin-bottom: 10px;
            font-size: 15px;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
@endpush

@push('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            let field = document.getElementById('editableField');
            if (field) {
                field.addEventListener('click', function() {
                    field.removeAttribute('readonly');
                    field.value = "";
                    field.placeholder = "Enter new 6-digit password";
                });
            }
        });
    </script> --}}
@endpush
