@extends('Layouts.layouts')

@section('content')
<div class="main-wrapper">
    <!-- Heading -->
    <div class="heading">
        <div class="link">
            <a href="{{ url()->previous()  }}"><i class="fa-solid fa-arrow-left-long"></i></a>
            <a href="#">Reset Password</a>
        </div>

    </div>

    <!-- Form -->
    <div class="form-container p-4">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" placeholder="Enter your email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="formbtn1">Reset Password</button>

        </form>
    </div>
</div>
@endsection

{{-- 
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
        body: JSON.stringify({ email })
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
@endpush --}}


 