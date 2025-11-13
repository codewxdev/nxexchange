<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Hello, world!</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        .user-dropdown {
            position: relative;
        }

        .animate-dropdown {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            display: none;
            min-width: 220px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            top: 47px;
        }

        .user-dropdown.show .animate-dropdown {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

 
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
    </style>

    @stack('style')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo2.png') }}" alt="" width="80px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Market</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('trade.index') }}">Trade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Assets</a>
                    </li>

                </ul>
                @if (auth()->user())
                <ul class="navbar-nav  mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Share</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Set</a>
                    </li>
                    <li class="nav-item dropdown user-dropdown d-flex">
                        <span class="profile-icon">{{ strtoupper(substr(auth()->user()->email, 0, 1)) }}</span>
                        <a class="nav-link active dropdown-toggle" href="#" id="userDropdown" role="button">
                            {{ auth()->user()->email }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end animate-dropdown" aria-labelledby="userDropdown">
                            <div class="px-3 py-2">
                                <p><strong>ID:</strong> {{ auth()->user()->id }}</p>
                                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                <!-- Add more info as needed -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>

                </ul>
                @else
                <div class="btns">
                    <a href="{{ route('login.index') }}"><button class="btn btn-primary btn1">Sign In</button></a>
                    <a href="{{ route('register.index') }}"><button class="btn btn-primary btn2">Register
                            now</button></a>
                </div>
                <select name="" id="language">
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="de">Duch</option>
                    <option value="de">Duch</option>
                </select>
                @endif

            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="brand-footer">
        <div class="container py-5">
            <div class="row">
                <!-- Logo & Description -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="#" class="footer-logo">
                        <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" />
                    </a>
                    <p class="footer-desc mt-3">
                        NxExchange is your one-stop cryptocurrency platform offering safe, high-yield investments and
                        global coverage.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">Market</a></li>
                        <li><a href="#">Trade</a></li>
                        <li><a href="#">Assets</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Company</h5>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Terms & Privacy</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title">Subscribe to Our Newsletter</h5>
                    <p>Get the latest crypto updates, market news, and exclusive offers.</p>
                    <form class="newsletter-form d-flex mt-3">
                        <input type="email" placeholder="Enter your email" />
                        <button type="submit">Subscribe</button>
                    </form>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

            </div>

            <div class="footer-bottom text-center mt-4">
                <p>&copy; 2025 NxExchange. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggle = document.getElementById('userDropdown');
        const dropdownMenu = dropdownToggle.nextElementSibling;

        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault();
            dropdownToggle.parentElement.classList.toggle('show');
        });

        // Click outside to close
        document.addEventListener('click', function(e) {
            if (!dropdownToggle.parentElement.contains(e.target)) {
                dropdownToggle.parentElement.classList.remove('show');
            }
        });
    });
    </script>

    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    @stack('scripts')

</body>

</html>