<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo3.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <title>Nx Exchange</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @stack('style')
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

        .identity-btn {
            /* background: #f46523b2; */
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
            color: #010101;
            text-decoration: none;
            transition: .4s all;
        }

        .identity-btn:hover {
            background: #ff783a;
            color: #010101;
        }

        .kyc-btn {
            display: block;
            background: #ff783a;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            color: #fff !important;
            text-align: center;
            text-decoration: none;
            transition: .3s ease;
            margin-top: 10px;
        }

        .kyc-btn:hover {
            background: #e8682f;
        }

        /* Pending */
        .kyc-badge.kyc-pending {
            display: block;
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }

        /* Verified */
        .kyc-badge.kyc-verified {
            display: block;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }

        .admin-btn {
            display: block;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }

        .notif-badge {
            position: absolute;
            top: 0px;
            right: 11px;
            background: #ff3b30;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Notification Panel Style */
        .notification-panel {
            position: absolute;
            top: 70px;
            right: 287px;
            width: 320px;
            background: rgba(255, 255, 255, 0.11);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .notification-panel.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .notification-panel .title {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 8px;
        }

        /* Notification Item */
        .notif-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.07);
            margin-bottom: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .notif-item:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        .notif-text p {
            margin: 0;
            color: #e9e9e9;
            font-size: 13px;
        }

        .notif-text strong {
            color: #fff;
            font-size: 14px;
        }

        .time {
            color: #ddd;
            font-size: 12px;
            white-space: nowrap;
        }

        .single-note {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
        }

        .single-note:hover {
            transform: translateY(-2px);
        }

        .delete-note {
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            transition: .3s;
            height: 0;
        }

        .delete-note:hover {
            /* background: #ffe2e2; */
            color: #f44336;
        }
    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo3.png') }}"
                    alt="" width="80px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('market.index') }}">Market</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('trade.index') }}">Trade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('asset.index') }}">Assets</a>
                    </li>
                </ul>
                @if (auth()->user())
                    <ul class="navbar-nav  mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('transaction.index') }}">Transaction Records</a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link active messages-btn" aria-current="page" href="javascript:void(0)">
                                Messages
                            </a>
                            @php
                                $unread = auth()->user()->notifications()->where('is_read', false)->count();
                            @endphp
                            <!-- Notification badge -->
                            @if (!empty($unread))
                                <span class="notif-badge">{{ $unread }}</span>
                            @endif

                        </li>

                        <!-- Notification Panel Wrapper -->
                        <div id="notificationPanel" class="notification-panel">
                            <h5 class="title">Notifications</h5>
                            @forelse (auth()->user()->notifications()->latest()->take(10)->get() as $notif)
                                <div class="notif-item">
                                    <div class="notif-text">
                                        <strong>{{ $notif->title }}</strong>
                                        <p>{{ $notif->message }}</p>
                                    </div>
                                    <span class="time">{{ $notif->created_at->diffForHumans() }}</span>
                                    <span class="delete-note" data-id="{{ $notif->id }}">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            @empty
                                <div id="emptyNoti" class="text-center py-4 text-muted">
                                    <i class="fa-regular fa-bell-slash fs-1"></i>
                                    <p>No notifications</p>
                                </div>
                            @endforelse
                        </div>

                        {{-- <div id="notificationList">
                            @forelse (auth()->user()->notifications()->latest()->take(10)->get() as $note)
                                <div class="single-note d-flex justify-content-between align-items-start mb-2 p-2">
                                    <div>
                                        <strong>{{ $note->title }}</strong>
                                        <p class="m-0">{{ $note->message }}</p>
                                    </div>

                                    <span class="delete-note" data-id="{{ $note->id }}">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            @empty
                                <div id="emptyNoti" class="text-center py-4 text-muted">
                                    <i class="fa-regular fa-bell-slash fs-1"></i>
                                    <p>No notifications</p>
                                </div>
                            @endforelse
                        </div> --}}


                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('share.index') }}">Share</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('help.index') }}">Help</a>
                        </li>

                        <li class="nav-item dropdown user-dropdown d-flex">
                            <span class="profile-icon">{{ strtoupper(substr(auth()->user()->email, 0, 1)) }}</span>
                            <a class="nav-link active dropdown-toggle" href="#" id="userDropdown" role="button">
                                {{ auth()->user()->email }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end animate-dropdown"
                                aria-labelledby="userDropdown">
                                <div class="px-3 py-2">
                                    <p><strong>ID:</strong> {{ auth()->user()->id }}</p>
                                    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                    @php
                                        $kyc = auth()->user()->kyc_status;
                                    @endphp

                                    @if ($kyc === 'pending' && auth()->user()->role !== 'admin')
                                        <span class="kyc-badge kyc-pending"> Pending Verification</span>
                                    @elseif ($kyc === 'verified' && auth()->user()->role !== 'admin')
                                        <span class="kyc-badge kyc-verified">✔ Verified</span>
                                    @elseif (auth()->user()->role !== 'admin')
                                        <a href="{{ route('kyc.index') }}" class="kyc-btn">Verify Your Identity</a>
                                    @endif

                                    <!-- Add more info as needed -->
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="admin-btn">Admin Panel</a>
                                    @endif

                                </div>
                            </div>
                        </li>

                    </ul>
                @else
                    <div class="btns">
                        <a href="{{ route('login.index') }}"><button class="btn btn-primary btn1">Sign
                                In</button></a>
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
                        <li><a href="{{ route('market.index') }}">Market</a></li>
                        <li><a href="{{ route('trade.index') }}">Trade</a></li>
                        <li><a href="{{ route('asset.index') }}">Assets</a></li>
                        {{-- <li><a href="#">Pricing</a></li>
                        <li><a href="#">Support</a></li> --}}
                    </ul>
                </div>

                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Company</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('about.index') }}">About Us</a></li>
                        {{-- <li><a href="#">Careers</a></li> --}}
                        {{-- <li><a href="#">Blog</a></li> --}}
                        <li><a href="{{ route('contact.index') }}">Contact</a></li>
                        <li><a href="{{ route('help.terms') }}">Terms & Privacy</a></li>
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
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('userDropdown');
            const dropdownMenu = dropdownToggle.nextElementSibling;

            dropdownToggle.addEventListener('click', function(e) {
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>

    <script>
        const messagesBtn = document.querySelector('.messages-btn');
        const panel = document.getElementById('notificationPanel');

        messagesBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            panel.classList.toggle('show');
        });

        // Click outside → hide panel
        document.addEventListener('click', function() {
            panel.classList.remove('show');
        });

        $(document).on('click', '.delete-note', function() {

            let id = $(this).data('id');
            let noteBox = $(this).closest('.notif-item'); // FIXED

            $.ajax({
                url: "/notification/" + id,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },

                success: function(res) {
                    if (res.success) {

                        noteBox.fadeOut(300, function() {
                            $(this).remove();

                            // -------- UPDATE BADGE COUNT -------- //
                            let badge = $('.notif-badge');
                            if (badge.length) {
                                let count = parseInt(badge.text()) - 1;

                                if (count > 0) {
                                    badge.text(count);
                                } else {
                                    badge.remove(); // hide badge completely
                                }
                            }

                            // -------- SHOW EMPTY MESSAGE -------- //
                            if ($('#notificationPanel .notif-item').length === 0) {
                                $('#notificationPanel').append(`
                            <div id="emptyNoti" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-bell-slash fs-1"></i>
                                <p>No notifications</p>
                            </div>
                        `);
                            }
                        });
                    }
                }
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
