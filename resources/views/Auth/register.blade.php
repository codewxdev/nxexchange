 @extends('Layouts.layouts')

 @section('content')
     <div class="main-wrapper">
         <!-- Heading -->
         <div class="heading">
             <div class="link">
                 <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left-long"></i></a>
                 <a href="#">{{ 'Register' }}
                 </a>
             </div>
             {{-- <select id="dropdown">
                 <option value="">English</option>
                 <option value="">Urdu</option>
                 <option value="">bangali</option>
                 <option value="">pashto</option>
                 <option value="">French</option>
                 <option value="">Urdu</option>
             </select> --}}
             <select onchange="window.location.href=this.value">
                 <option value="{{ route('change.lang', 'en') }}" {{ session('locale') == 'en' ? 'selected' : '' }}>English
                 </option>
                 <option value="{{ route('change.lang', 'ur') }}" {{ session('locale') == 'ur' ? 'selected' : '' }}>Urdu
                 </option>
                 <option value="{{ route('change.lang', 'fr') }}" {{ session('locale') == 'fr' ? 'selected' : '' }}>French
                 </option>
                 <option value="{{ route('change.lang', 'es') }}" {{ session('locale') == 'es' ? 'selected' : '' }}>Spanish
                 </option>
             </select>

         </div>

         <!-- Form -->
         <div class="form-container">
             <form action="{{ route('register.store') }}" method="POST">
                 @csrf
                 {{-- Name --}}
                 <div class="mb-3">
                     <label class="form-label">{{ 'Your Name' }}</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                         name="name" value="{{ old('name') }}" placeholder="Enter your full name">
                     @error('name')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                 </div>

                 {{-- Email --}}
                 <div class="mb-3">
                     <label class="form-label">{{ 'Your Mailbox' }}</label>
                     <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                         name="email" value="{{ old('email') }}" placeholder="Enter your email">
                     @error('email')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                 </div>

                 {{-- Verification Code --}}
                 <div class="mb-3">
                     <label class="form-label">{{ 'Enter Verification Code' }}</label>
                     <div class="verify-div">
                         <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                             name="code" placeholder="Enter verification code" value="{{ old('code') }}">
                         <button type="button" class="btn btn-primary" id="sendCodeBtn">Send</button>
                     </div>
                     @error('code')
                         <div class="text-danger mt-1 small">{{ $message }}</div>
                     @enderror
                 </div>

                 {{-- Password --}}
                 <div class="mb-3">
                     <label class="form-label">{{ 'Your Password' }}</label>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                         name="password" placeholder="Enter password">
                     @error('password')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                 </div>

                 {{-- Confirm Password --}}
                 <div class="mb-3">
                     <label class="form-label">{{ 'Your Password Name' }}</label>
                     <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                         placeholder="Confirm password">
                 </div>
                 {{-- Invitation code --}}
                 <div class="mb-3">
                     <label class="form-label">{{ 'Enter Invitation Code' }}</label>
                     <input type="text" name="invitation_code"
                         class="form-control @error('invitation_code') is-invalid @enderror"
                         value="{{ request('ref') ?? old('invitation_code') }}" placeholder="Invitation code">

                     @error('invitation_code')
                         <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                 </div>

                 {{-- Remember Me --}}
                 <div class="form-check mb-3">
                     <input type="checkbox" name="remember" class="form-check-input" id="remember"
                         {{ old('remember') ? 'checked' : '' }}>
                     <label class="form-check-label" for="remember">{{ 'Remember me' }}</label>
                 </div>

                 <button type="submit" class="formbtn1">{{ 'Register' }}</button>
                 <a href="{{ route('login.index') }}"><button type="button"
                         class="formbtn2">{{ 'Already Have An Account' }}?</button></a>
             </form>
         </div>
     </div>
 @endsection

 @push('customJs')
     <script>
         toastr.options = {
             "closeButton": true,
             "progressBar": true,
             "positionClass": "toast-top-right",
             "timeOut": "4000"
         }
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
                     toastr.success("Code sent! Check your email");
                 })
                 .catch(() => {
                     toastr.error("something went wrong");
                 });
         });
     </script>
 @endpush
