@extends('Layouts.layouts')

@section('content')
<div class="main-wrapper">
    <!-- Heading -->
    <div class="heading">
        <div class="link">
            <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left-long"></i></a>
            <a href="#">Password Reset</a>
        </div>
        <select id="dropdown">
            <option value="">English</option>
            <option value="">Urdu</option>
            <option value="">bangali</option>
            <option value="">pashto</option>
            <option value="">French</option>
            <option value="">Urdu</option>
        </select>
    </div>

    <!-- Form -->
    <div class="form-container">
        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control" required>
            </div>
            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label">Your Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Enter password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <label class="form-label">Enter Password Again</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Confirm password">
            </div>

            <button type="submit" class="formbtn1">Reset</button>

        </form>
    </div>
</div>
@endsection


@push('customJs')
<script>
    document.querySelector('.btn.btn-primary').addEventListener('click', function() {
            const email = document.getElementById('email').value;

            if (!email) {
                alert('Please enter your email first.');
                return;
            }

            fetch("{{ route('send.code') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        email
                    })
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(() => {
                    alert("Something went wrong!");
                });
        });
</script>
@endpush



</body>

</html>